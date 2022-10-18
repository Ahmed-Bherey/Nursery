<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leavel;
use App\Models\AddChild;
use App\Models\Treasury;
use App\Models\BuyUniform;
use App\Models\SellUniform;
use App\Models\BuyBookTotal;
use Illuminate\Http\Request;
use App\Models\BuyUniformTotal;
use App\Models\DaycareSettieng;
use App\Models\EducationalYear;
use App\Models\TreasuryProcess;
use App\Models\SellUniformTotal;
use App\Models\ChildRegistration;
use App\Http\Controllers\Controller;
use Alkoumi\LaravelArabicNumbers\Numbers;

class SellUniformController extends Controller
{
    //
    public function create()
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $children = AddChild::where('delete_at', 0)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $buyUniforms = BuyUniform::where('delete_at', 0)->get();
        $sellUniformTotals = SellUniformTotal::where('delete_at', 0)->where('year_id', $year_id)->get();
        $sellUniforms = SellUniform::where('delete_at', 0)->where('year_id', $year_id)->get();
        $treasuries = Treasury::where('delete_at', 0)->get();
        return view('admin.pages.sellUniforms.create', compact('sellUniforms', 'children', 'levels', 'buyUniforms', 'sellUniformTotals', 'treasuries'));
    }

    public function store(Request $request)
    {
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');
        // if($balance < $request->total){
        //     return redirect()->back()->with(['error' => "رصيد الخزنه لايسمح"]);
        // }
        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance + $request->total,
        ]);

        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $sellUniformTotals = SellUniformTotal::create([
            'year_id' => $year_id,
            'date' => $request->date,
            'level_id' => $request->level_id,
            'child_id' => $request->child_id,
            'treasury_id' => $request->treasury_id,
            'notes' => $request->notes,
            'total' => $request->total,
        ]);
        foreach ($request->data['quantity'] as $key => $value) {
            SellUniform::create([
                'year_id' => $year_id,
                'sellUniformTotal_id' => $sellUniformTotals->id,
                'buyUniform_id' => $request->data['buyUniform_id'][$key],
                'quantity' => $value,
                'price' => $request->data['price'][$key],
                'subTotal' => $request->data['subTotal'][$key],
            ]);

            $name = BuyUniform::where('id', $request->data['buyUniform_id'][$key])->value('name');
            $child = AddChild::where('id', $request->child_id)->value('name_ar');
            TreasuryProcess::create([
                'date' => $request->date,
                'sellUniform_id' => $sellUniformTotals->id,
                'treasury_id' => $request->treasury_id,
                'debt' => $request->data['subTotal'][$key],
                'comment' => ' بيع ' . '' . $name . ' للطفل ' . '' . $child,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {

        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $children = AddChild::where('delete_at', 0)->where('year_id', $year_id)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $buyUniforms = BuyUniform::where('delete_at', 0)->where('year_id', $year_id)->get();
        $sellUniformTotals = SellUniformTotal::where('delete_at', 0)->where('year_id', $year_id)->findOrFail($id);
        $sellUniforms = SellUniform::where('delete_at', 0)->where('year_id', $year_id)->where('sellUniformTotal_id', $id)->get();
        $treasuries = Treasury::where('delete_at', 0)->get();

        return view('admin.pages.sellUniforms.edit', compact('sellUniforms', 'children', 'levels', 'buyUniforms', 'sellUniformTotals', 'treasuries'));
    }

    public function update(Request $request, $id)
    {
        $year_id = EducationalYear::where('active', 1)->value('id');
        $sellUniformTotals = SellUniformTotal::where('year_id', $year_id)->findOrFail($id);
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');
        $buyPrice = SellUniformTotal::where('delete_at', 0)
            ->where('year_id', $year_id)
            ->where('level_id', $request->level_id)
            ->where('child_id', $request->child_id)
            ->value('total');
        $data = $buyPrice - $request->total;
        if ($balance < $request->total_buy) {
            return redirect()->back()->with(['success' => "رصيد الخزنه لايسمح"]);
        }
        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance - $data,

        ]);
        SellUniform::where('delete_at', 0)
            ->where('year_id', $year_id)
            ->where('sellUniformTotal_id', $id)
            ->delete();
        foreach ($request->data['quantity'] as $key => $value) {
            SellUniform::create([
                'year_id' => $year_id,
                'sellUniformTotal_id' => $sellUniformTotals->id,
                'buyUniform_id' => $request->data['buyUniform_id'][$key],
                'quantity' => $value,
                'price' => $request->data['price'][$key],
                'subTotal' => $request->data['subTotal'][$key],
            ]);
        }
        $sellUniformTotals->update([
            'year_id' => $year_id,
            'date' => $request->date,
            'level_id' => $request->level_id,
            'child_id' => $request->child_id,
            'treasury_id' => $request->treasury_id,
            'notes' => $request->notes,
            'total' => $request->total,
        ]);

        TreasuryProcess::create([
            'date' => $request->date,
            'sellUniform_id' => $sellUniformTotals->id,
            'treasury_id' => $request->treasury_id,
            'debt' => $request->total,
            'comment' => 'تعديل بيع زى مدرسى',
        ]);
        return redirect()->route('sellUniform.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $treasury_id = SellUniformTotal::where('delete_at', 0)->where('id', $id)->value('treasury_id');
        $level_id = SellUniformTotal::where('delete_at', 0)->where('id', $id)->value('level_id');
        $child_id = SellUniformTotal::where('delete_at', 0)->where('id', $id)->value('child_id');
        $buyPrice = SellUniformTotal::where('delete_at', 0)
            ->where('id', $id)->where('level_id', $level_id)
            ->where('child_id', $child_id)
            ->value('total');
        $balance = Treasury::where('id', $treasury_id)->value('balance');
        Treasury::where('id', $treasury_id)->update([
            'balance' => $balance - $buyPrice,
        ]);
        SellUniform::where('delete_at', 0)->where('sellUniformTotal_id', $id)->update([
            'delete_at' => 1,
        ]);
        SellUniformTotal::where('delete_at', 0)->where('id', $id)->update([
            'delete_at' => 1,
        ]);
        TreasuryProcess::create([
            'sellUniform_id' => $id,
            'treasury_id' => $treasury_id,
            'debt' => $buyPrice,
            'comment' => 'حذف بيع زى مدرسى',
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function sellUniformChildrenAjax($id)
    {
        $children = ChildRegistration::where('level_id', $id)->with('children')->get();
        return json_encode($children);
    }

    public function sellPriceAjax($id)
    {
        $sellPrice = BuyUniform::where('id', $id)->value('sale_price');
        return json_encode($sellPrice);
    }

    public function sellPriceBookAjax($id)
    {
        $sellPrice = BuyBookTotal::where('id', $id)->value('sellPrice');
        return json_encode($sellPrice);
    }

    public function print(Request $request, $id)
    {
        $daycareSettieng = DaycareSettieng::first();
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $children = AddChild::where('delete_at', 0)->where('year_id', $year_id)->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $buyUniforms = BuyUniform::where('delete_at', 0)->where('year_id', $year_id)->get();
        $sellUniformTotals = SellUniformTotal::where('delete_at', 0)->where('year_id', $year_id)->findOrFail($id);
        $sellUniforms = SellUniform::where('delete_at', 0)->where('year_id', $year_id)->where('sellUniformTotal_id', $id)->with('sellUniformTotals')->get();
        $treasuries = Treasury::where('delete_at', 0)->get();
        $total = SellUniformTotal::where('id', $id)->value('total');
        $x = number_format($total, 2);
        $Tafqeet = Numbers::TafqeetMoney($total, 'EGP');
        return view('admin.pages.sellUniforms.print', compact('sellUniforms', 'x', 'Tafqeet', 'daycareSettieng', 'children', 'levels', 'buyUniforms', 'sellUniformTotals', 'treasuries'));
    }
}
