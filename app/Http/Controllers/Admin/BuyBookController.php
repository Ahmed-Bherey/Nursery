<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuyBook;
use App\Models\BuyBookTotal;
use App\Models\EducationalYear;
use App\Models\Treasury;
use App\Models\TreasuryProcess;
use Illuminate\Http\Request;

class BuyBookController extends Controller
{
    //
    public function create()
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');

        if ($year_id < 0) {
            return redirect()->back()->with(['success' => " تاكد من وجود سنه مفعله "]);
        }
        $buyBooks = BuyBook::where('delete_at', 0)->where('year_id', $year_id)->get();
        $treasuries = Treasury::where('delete_at', 0)->get();
        return view('admin.pages.buyBooks.create', compact('buyBooks', 'treasuries'));
    }

    public function store(Request $request)
    {

        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        if ($year_id < 0) {
            return redirect()->back()->with(['success' => " تاكد من وجود سنه مفعله "]);
        }
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');
        if ($balance < $request->total) {
            return redirect()->back()->with(['success' => "رصيد الخزنه لايسمح"]);
        }
        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance - $request->total,
        ]);

        $buyBook = BuyBook::create([
            'date' => $request->date,
            'year_id' => $year_id,
            'supplier' => $request->supplier,
            'note' => $request->note,
            'totalBuyPrice' => $request->total,
            'totalSellPrice' => Null,
            'treasury_id' => $request->treasury_id,
        ]);

        foreach ($request->data['name'] as $key => $name) {
            BuyBookTotal::create([
                'name' => $name,
                'year_id' => $year_id,
                'amount' => $request->data['amount'][$key],
                'buyPrice' => $request->data['buyPrice'][$key],
                'sellPrice' => $request->data['sellPrice'][$key],
                'buyBook_id' => $buyBook->id,
                'subTotal' => $request->data['subTotal'][$key],
            ]);

            TreasuryProcess::create([
                'date' => $request->date,
                'buyBook_id' => $buyBook->id,
                'treasury_id' => $request->treasury_id,
                'credit' => $request->data['subTotal'][$key],
                'comment' => ' شراء ' . '' . $name . '' . " من " . '' . $request->supplier,
            ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $treasuries = Treasury::where('delete_at', 0)->get();
        $buyBook = BuyBookTotal::findOrFail($id);
        return view('admin.pages.buyBooks.edit', compact('buyBook', 'treasuries'));
    }

    public function update(Request $request, $id)
    {
        $buyBookId = BuyBook::find($id);
        $buyBook = BuyBook::where();
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');
        if ($balance < $request->total) {
            return redirect()->back()->with(['success' => "رصيد الخزنه لايسمح"]);
        }
        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance - $request->buyPrice,

        ]);

        $lasBalance = BuyBookTotal::where('id', $id)->value('buyPrice');
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');
        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance + $lasBalance,

        ]);
        BuyBookTotal::where('id', $id)->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'buyPrice' => $request->buyPrice,
            'sellPrice' => $request->sellPrice,
            'subTotal' => $request->subTotal,

        ]);

        TreasuryProcess::create([
            'date' => $request->date,
            'buyBook_id' => $buyBookId->id,
            'treasury_id' => $request->treasury_id,
            'credit' => $request->total,
            'comment' => 'تعديل شراء كتب',

        ]);

        return redirect()->route('buyBooks.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        BuyBookTotal::where('buyBook_id', $id)->update([
            'delete_at' => 1,
        ]);
        BuyBook::where('id', $id)->update([
            'delete_at' => 1,
        ]);
        $treasury_id = BuyBook::where('id', $id)->value('treasury_id');
        $total = BuyBook::where('id', $id)->value('totalBuyPrice');
        $balance = Treasury::where('id', $treasury_id)->value('balance');
        if ($balance < $total) {
            Treasury::where('id', $treasury_id)->update([
                'balance' => $balance + $total,

            ]);
        }
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function delete($id)
    {
        $treasury_id = BuyBookTotal::where('id', $id)->value('treasury_id');
        $total = BuyBookTotal::where('id', $id)->value('totalBuyPrice');

        TreasuryProcess::create([
            'buyBook_id' => $id,
            'treasury_id' => $treasury_id,
            'credit' => $total,
            'comment' => 'حذف شراء كتب',

        ]);
        BuyBookTotal::where('id', $id)->update([
            'delete_at' => 1,
        ]);
        $balance = BuyBookTotal::where('id', $treasury_id)->value('buyPrice');
        if ($balance < $total) {
            Treasury::where('id', $treasury_id)->update([
                'balance' => $balance + $total,

            ]);
        }
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function show($id)
    {
        $buyBooks = BuyBookTotal::where('delete_at', 0)->where('buyBook_id', $id)->get();
        $buyBookId = BuyBook::where('delete_at', 0)->where('id', $id)->value('id');

        return view('admin.pages.buyBooks.show', compact('buyBookId', 'buyBooks'));
    }
}
