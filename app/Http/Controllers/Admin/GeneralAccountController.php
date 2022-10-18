<?php

namespace App\Http\Controllers\Admin;

use App\Models\Treasury;
use Illuminate\Http\Request;
use App\Models\GeneralAccount;
use App\Models\GeneralExpensese;
use App\Http\Controllers\Controller;
use App\Models\TreasuryProcess;

class GeneralAccountController extends Controller
{
    //
    public function create()
    {
        $treasuries = Treasury::where('delete_at',0)->where('active', 1)->get();
        $generalExpenseses = GeneralExpensese::where('delete_at',0)->get();
        $generalAccounts = GeneralAccount::where('delete_at',0)->get();
        return view('admin.pages.generalAccounts.create', compact('generalAccounts', 'treasuries', 'generalExpenseses'));
    }

    public function store(Request $request)
    {
        $treasury_balance = Treasury::where('id', $request->treasury_id)->value('balance');
        if ($treasury_balance >= $request->amount) {
            GeneralAccount::create([
                'date' => $request->date,
                'treasury_id' => $request->treasury_id,
                'generalExpensese_id' => $request->generalExpensese_id,
                'amount' => $request->amount,
            ]);
            Treasury::where('id', $request->treasury_id)->update([
                'balance' => $treasury_balance - $request->amount,
            ]);
            TreasuryProcess::create([
                'date' => $request->date,
                'generalAccount_id' => $request->generalExpensese_id,
                'treasury_id' => $request->treasury_id,
                'credit' => $request->amount,
                'comment'=>'مصروفات عامة',
            ]);
        } else {
            return redirect()->back()->with(['error' => "عذرا الرصيد لا يسمح"]);
        }
        return redirect()->back()->with(['success' => " تم  بنجاح"]);
    }

    public function edit($id)
    {
        $treasuries = Treasury::where('delete_at',0)->where('active', 1)->get();
        $generalExpenseses = GeneralExpensese::where('delete_at',0)->get();
        $generalAccounts = GeneralAccount::findOrFail($id);
        return view('admin.pages.generalAccounts.edit', compact('generalAccounts', 'treasuries', 'generalExpenseses'));
    }

    public function update(Request $request, $id)
    {
        $generalAccounts = GeneralAccount::findOrFail($id);
        $treasury_balance = Treasury::where('id', $request->treasury_id)->value('balance');
        $generalAccounts_amount = GeneralAccount::where('treasury_id', $request->treasury_id)
                ->where('generalExpensese_id', $request->generalExpensese_id)
                ->where('delete_at',0)
                ->value('amount');
            $data = $generalAccounts_amount - $request->amount;
        if ($treasury_balance >= $data) {
            Treasury::where('id', $request->treasury_id)->update([
                'balance' => $treasury_balance + $data,
            ]);
            $generalAccounts->update([
                'date' => $request->date,
                'treasury_id' => $request->treasury_id,
                'generalExpensese_id' => $request->generalExpensese_id,
                'amount' => $request->amount,
            ]);
            TreasuryProcess::create([
                'date' => $request->date,
                'generalAccount_id' => $request->generalExpensese_id,
                'treasury_id' => $request->treasury_id,
                'credit' => $request->amount,
                'comment'=>'تعديل مصروفات عامة',
            ]);
        } else {
            return redirect()->back()->with(['error' => "عذرا الرصيد لا يسمح"]);
        }
        return redirect()->route('generalAccount.create')->with(['success' => "تم التحديث بنجاح"]);
    }

    public function destroy($id)
    {
        $treasury_id = GeneralAccount::where('delete_at', 0)->where('id', $id)->value('treasury_id');
        $generalExpensese_id = GeneralAccount::where('delete_at', 0)->where('id', $id)->value('generalExpensese_id');
        $amount = GeneralAccount::where('delete_at', 0)
        ->where('id', $id)->where('treasury_id',$treasury_id)
        ->where('generalExpensese_id',$generalExpensese_id)
        ->value('amount');
        $balance = Treasury::where('id', $treasury_id)->value('balance');
        Treasury::where('id', $treasury_id)->update([
            'balance' => $balance + $amount,
        ]);
        $generalAccounts = GeneralAccount::findOrFail($id);
        $generalAccounts->update([
            'delete_at'=>1,
        ]);
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function generalAccountAjax($id){
        $generalAccountAjax = GeneralExpensese::where('delete_at',0)->where('id',$id)->value('price');
        return json_encode($generalAccountAjax);
    }
}
