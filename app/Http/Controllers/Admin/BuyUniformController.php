<?php

namespace App\Http\Controllers\Admin;

use App\Models\Treasury;
use App\Models\BuyUniform;
use App\Models\BuyBookTotal;
use Illuminate\Http\Request;
use App\Models\BuyUniformTotal;
use App\Models\DaycareSettieng;
use App\Models\EducationalYear;
use App\Models\TreasuryProcess;
use App\Http\Controllers\Controller;

class BuyUniformController extends Controller
{
    //
    public function create()
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $buyUniformTotals = BuyUniformTotal::where('delete_at', 0)->where('year_id', $year_id)->get();
        $buyUniforms = BuyUniform::where('delete_at', 0)->where('year_id', $year_id)->get();
        $treasuries = Treasury::where('delete_at', 0)->get();
        return view('admin.pages.buyUniforms.create', compact('buyUniforms', 'buyUniformTotals', 'treasuries'));
    }

    public function store(Request $request)
    {
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');
        if ($balance < $request->total_sale) {
            return redirect()->back()->with(['error' => "رصيد الخزنه لايسمح"]);
        }
        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance - $request->total_sale,

        ]);

        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $buyUniformTotals = BuyUniformTotal::create([
            'year_id' => $year_id,
            'date' => $request->date,
            'supplier' => $request->supplier,
            'notes' => $request->notes,
            'total_buy' => $request->total_buy,
            'total_sale' => $request->total_sale,
            'treasury_id' => $request->treasury_id,
        ]);
        foreach ($request->data['name'] as $key => $value) {
            BuyUniform::create([
                'year_id' => $year_id,
                'buyUniformTotal_id' => $buyUniformTotals->id,
                'name' => $value,
                'quantity' => $request->data['quantity'][$key],
                'buy_price' => $request->data['buy_price'][$key],
                'sale_price' => $request->data['sale_price'][$key],
                'subTotal' => $request->data['subTotal'][$key],

            ]);

            TreasuryProcess::create([
                'date' => $request->date,
                'buyUniform_id' => $buyUniformTotals->id,
                'treasury_id' => $request->treasury_id,
                'credit' => $request->data['subTotal'][$key],
                'comment' => ' شراء ' . '' . $value . '' . " من " . '' . $request->supplier,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $buyUniforms = BuyUniform::where('delete_at', 0)->where('year_id', $year_id)->where('buyUniformTotal_id', $id)->get();
        $buyUniformTotals = BuyUniformTotal::where('delete_at', 0)->where('year_id', $year_id)->findOrFail($id);
        $treasuries = Treasury::where('delete_at', 0)->get();
        return view('admin.pages.buyUniforms.edit', compact('buyUniforms', 'buyUniformTotals', 'treasuries'));
    }

    public function update(Request $request, $id)
    {
        $buyUniformTotals = BuyUniformTotal::findOrFail($id);
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $treasury_balance = Treasury::where('delete_at', 0)->where('id', $request->treasury_id)->value('balance');
        $sellPrice = BuyUniformTotal::where('delete_at', 0)->where('year_id', $year_id)->where('treasury_id', $request->treasury_id)->value('total_sale');
        $data = $sellPrice - $request->total_sale;
        Treasury::where('delete_at', 0)->where('id', $request->treasury_id)->update([
            'balance' => $treasury_balance + $data,
        ]);
        $buyUniform = BuyUniform::where('delete_at', 0)->where('delete_at', 0)->where('buyUniformTotal_id', $id)->delete();
        foreach ($request->data['name'] as $key => $value) {
            BuyUniform::create([
                'year_id' => $year_id,
                'buyUniformTotal_id' => $buyUniformTotals->id,
                'name' => $value,
                'quantity' => $request->data['quantity'][$key],
                'buy_price' => $request->data['buy_price'][$key],
                'sale_price' => $request->data['sale_price'][$key],
                'subTotal' => $request->data['subTotal'][$key],
            ]);
            TreasuryProcess::create([
                'date' => $request->date,
                'buyUniform_id' => $buyUniformTotals->id,
                'treasury_id' => $request->treasury_id,
                'credit' => $request->data['subTotal'][$key],
                'comment' => ' تعديل شراء ' . '' . $value . '' . " من " . '' . $request->supplier,
            ]);
        }
        $buyUniformTotals->update([
            'year_id' => $year_id,
            'date' => $request->date,
            'supplier' => $request->supplier,
            'notes' => $request->notes,
            'total_buy' => $request->total_buy,
            'total_sale' => $request->total_sale,
            'treasury_id' => $request->treasury_id,
        ]);

        return redirect()->route('buyUniform.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $treasury_id = BuyUniformTotal::where('delete_at', 0)->where('id', $id)->value('treasury_id');
        $sellTotal = BuyUniformTotal::where('delete_at', 0)->where('id', $id)->value('total_sale');
        $balance = Treasury::where('id', $treasury_id)->value('balance');

        TreasuryProcess::create([
            'buyUniform_id' => $id,
            'treasury_id' => $treasury_id,
            'credit' => $sellTotal,
            'comment' => '  حذف شراء زي مدرسى',
        ]);
        Treasury::where('id', $treasury_id)->update([
            'balance' => $balance + $sellTotal,
        ]);
        BuyUniform::where('delete_at', 0)->where('buyUniformTotal_id', $id)->update([
            'delete_at' => 1,
        ]);
        BuyUniformTotal::where('delete_at', 0)->where('id', $id)->update([
            'delete_at' => 1,
        ]);

        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function treasuryBalanceAjax($id)
    {
        $balance = Treasury::where('id', $id)->value('balance');
        return json_encode($balance);
    }
}
