<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leavel;
use App\Models\BuyBook;
use App\Models\AddChild;
use App\Models\SellBook;
use App\Models\Treasury;
use App\Models\BuyBookTotal;
use Illuminate\Http\Request;
use App\Models\DaycareSettieng;
use App\Models\EducationalYear;
use App\Models\TreasuryProcess;
use App\Http\Controllers\Controller;
use Alkoumi\LaravelArabicNumbers\Numbers;

class TestController extends Controller
{
    //
    public function create()
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        if ($year_id < 0) {
            return redirect()->back()->with(['success' => " تاكد من وجود سنه مفعله "]);
        }
        $sellBooks = SellBook::where('delete_at', 0)->where('year_id', $year_id)->groupBy(['date', 'child_id', 'level_id'])->get();
        $levels = Leavel::where('delete_at', 0)->get();
        $buyBooks = BuyBookTotal::where('delete_at', 0)->where('year_id', $year_id)->get();
        $treasuries = Treasury::where('delete_at', 0)->get();

        return view('admin.pages.sellBooks.create', compact('buyBooks', 'levels', 'sellBooks', 'treasuries'));
    }

    public function store(Request $request)
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        if ($year_id < 0) {
            return redirect()->back()->with(['success' => " تاكد من وجود سنه مفعله "]);
        }
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');

        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance + $request->total,
        ]);
        foreach ($request->data['book_id'] as $key => $book) {
            $amount = BuyBookTotal::where('delete_at', 0)->where('year_id', $year_id)->where('id', $book)->value('amount');
            $sellPrice = BuyBookTotal::where('delete_at', 0)->where('year_id', $year_id)->where('id', $book)->value('sellPrice');
            if ($amount < $request->data['amount'][$key]) {
                return redirect()->back()->with(['success' => $amount . "الكميه لاتسمح"]);
            }
        }
        foreach ($request->data['book_id'] as $key => $book) {
            $sellPrice = BuyBookTotal::where('delete_at', 0)->where('year_id', $year_id)->where('id', $book)->value('sellPrice');
            SellBook::create([
                'date' => $request->date,
                'year_id' => $year_id,
                'level_id' => $request->level_id,
                'child_id' => $request->child_id,
                'note' => $request->note,
                'total' => $request->total,
                'subTotal' => $request->subTotal,
                'book_id' => $book,
                'amount' => $request->data['amount'][$key],
                'price' => $sellPrice,
                'treasury_id' => $request->treasury_id,
            ]);

        TreasuryProcess::create([
            'buyBook_id' => $book,
            'treasury_id' =>$request->treasury_id,
            'debt' => $request->total,
            'comment'=>'بيع كتب',
        ]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $buyBook = SellBook::findOrFail($id);
        $treasuries = Treasury::where('delete_at', 0)->get();
        return view('admin.pages.sellBooks.edit', compact('buyBook', 'treasuries'));
    }

    public function update(Request $request, $id)
    {


        $books = BuyBook::where('delete_at', 0)->where('id', $request->book_id)->count();
        $name = BuyBook::where('delete_at', 0)->where('id',  $request->book_id)->value('name');
        if ($books < $request->amount) {
            return redirect()->back()->with(['success' => $name . "الكميه لاتسمح"]);
        }
        $balance = Treasury::where('id', $request->treasury_id)->value('balance');

        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance + $request->price,

        ]);

        $price = BuyBook::where('delete_at', 0)->where('id',  $request->book_id)->value('price');

        $balance = Treasury::where('id', $request->treasury_id)->value('balance');

        Treasury::where('id', $request->treasury_id)->update([
            'balance' => $balance - $price,

        ]);

        SellBook::where('id', $id)->update([
            'note' => $request->note,
            'amount' => $request->amount,
            'price' => $request->price,
            'subTotal' => $request->subTotal,
            'treasury_id' => $request->treasury_id,

        ]);
        TreasuryProcess::create([
            'buyBook_id' => $id,
            'treasury_id' =>$request->treasury_id,
            'debt' => $request->price,
            'comment'=>'تعديل بيع كتب',
        ]);

        return redirect()->route('sellBooks.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($date, $child_id, $level_id)
    {
        $year_id = EducationalYear::where('active', 1)->value('id');

        SellBook::where('year_id', $year_id)->where('child_id', $child_id)->where('level_id', $level_id)->where('date', $date)->update([
            'delete_at' => 1,
        ]);

        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function delete($id)
    {
        SellBook::where('id', $id)->update([
            'delete_at' => 1,
        ]);
        $price = SellBook::where('id', $id)->value('price');
        $treasury_id = SellBook::where('id', $id)->value('treasury_id');
        $balance = Treasury::where('id', $treasury_id)->value('balance');
        TreasuryProcess::create([
            'buyBook_id' => $id,
            'treasury_id' => $treasury_id,
            'credit' => $price,
            'comment'=>'حذف بيع كتب',

        ]);
        Treasury::where('id', $treasury_id)->update([
            'balance' => $balance - $price,

        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function show($date, $child_id, $level_id)
    {
        $year_id = EducationalYear::where('delete_at', 0)->where('active', 1)->value('id');
        $sellBooks = SellBook::where('delete_at', 0)->where('year_id', $year_id)->where('child_id', $child_id)->where('level_id', $level_id)->where('date', $date)->get();
        $child = SellBook::where('delete_at', 0)->where('year_id', $year_id)->where('child_id', $child_id)->where('level_id', $level_id)->where('date', $date)->first();

        return view('admin.pages.sellBooks.show', compact('child', 'sellBooks'));
    }

    public function print($id)
    {
        $daycareSettieng = DaycareSettieng::first();
        $SellBooks = SellBook::where('delete_at',0)->findOrFail($id);
        $SellBookss = SellBook::where('delete_at',0)->get();
        $treasuries = Treasury::where('delete_at', 0)->get();
        $children = AddChild::where('delete_at',0)->get();
        $levels = Leavel::where('delete_at',0)->get();
        $total = SellBook::where('id',$id)->value('total');
        $x = number_format($total,2);
        $Tafqeet =Numbers::TafqeetMoney($total,'EGP');
        return view('admin.pages.sellBooks.print', compact('SellBooks','SellBookss','daycareSettieng','treasuries','children','levels','total','x','Tafqeet'));
    }
}
