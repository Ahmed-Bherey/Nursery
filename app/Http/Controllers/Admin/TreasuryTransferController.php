<?php

namespace App\Http\Controllers\Admin;

use App\Models\Treasury;
use Illuminate\Http\Request;
use App\Models\TreasuryTransfer;
use App\Http\Controllers\Controller;
use App\Models\TreasuryProcess;
use Illuminate\Support\Facades\Auth;

class TreasuryTransferController extends Controller
{
    //
    public function create()
    {
        $treasuriesFrom = Treasury::where('delete_at', 0)->get();
        $treasuriesTo = Treasury::where('delete_at', 0)->get();
        $treasuryTransfers = TreasuryTransfer::get();
        return view('admin.pages.treasuryTransfers.create', compact('treasuryTransfers', 'treasuriesFrom', 'treasuriesTo'));
    }

    public function store(Request $request)
    {
        $balanceFrom = Treasury::where('id', $request->treasuryFrom_id)->value('balance');
        $balanceTo = Treasury::where('id', $request->treasuryTo_id)->value('balance');

        if ($request->amount > $balanceFrom) {
            return redirect()->back()->with(['error' => "عفوا رصيد الخزنة لا يسمح"]);
        } else {
            Treasury::where('id', $request->treasuryFrom_id)->update([
                'balance' => $balanceFrom - $request->amount,
            ]);

            Treasury::where('id', $request->treasuryTo_id)->update([
                'balance' => $balanceTo + $request->amount,
            ]);
            TreasuryTransfer::create([
                'date' => $request->date,
                'user_id' => Auth::user()->id,
                'treasuryFrom_id' => $request->treasuryFrom_id,
                'treasuryTo_id' => $request->treasuryTo_id,
                'amount' => $request->amount,
            ]);

            $treasuryFrom_name = Treasury::where('id',$request->treasuryFrom_id)->value('name');
            $treasuryTo_name = Treasury::where('id',$request->treasuryTo_id)->value('name');
            TreasuryProcess::create([
                'date' => $request->date,
                'treasury_id' =>$request->treasuryFrom_id,
                'credit' => $request->amount,
                'comment' => ' تحويل مبلغ ' . $request->amount . ' من ' . $treasuryFrom_name . '' . ' الى ' . '' . $treasuryTo_name,
            ]);

            TreasuryProcess::create([
                'date' => $request->date,
                'treasury_id' =>$request->treasuryTo_id,
                'debt' => $request->amount,
                'comment' => ' تحويل مبلغ ' . $request->amount . ' من ' . $treasuryFrom_name . '' . ' الى ' . '' . $treasuryTo_name,
            ]);

            return redirect()->back()->with(['success' => " تم  بنجاح"]);
        }
    }

    public function edit($id)
    {
        $treasuriesFrom = Treasury::where('delete_at', 0)->get();
        $treasuriesTo = Treasury::where('delete_at', 0)->get();
        $treasuryTransfers = TreasuryTransfer::findOrFail($id);
        return view('admin.pages.treasuryTransfers.edit', compact('treasuryTransfers', 'treasuriesFrom', 'treasuriesTo'));
    }

    public function update(Request $request, $id)
    {
        $balanceFrom = Treasury::where('id', $request->treasuryFrom_id)->value('balance');
        $balanceTo = Treasury::where('id', $request->treasuryTo_id)->value('balance');
        $amount = TreasuryTransfer::where('treasuryFrom_id', $request->treasuryFrom_id)
            ->where('treasuryFrom_id', $request->treasuryFrom_id)->value('amount');
        $data = $amount - $request->amount;
        if ($request->amount > $balanceFrom) {
            return redirect()->back()->with(['error' => "عفوا رصيد الخزنة لا يسمح"]);
        } else {
            Treasury::where('id', $request->treasuryFrom_id)->update([
                'balance' => $balanceFrom + $data,
            ]);
            Treasury::where('id', $request->treasuryTo_id)->update([
                'balance' => $balanceTo - $data,
            ]);

            $treasuryTransfers = TreasuryTransfer::findOrFail($id);
            $treasuryTransfers->update([
                'date' => $request->date,
                'user_id' => Auth::user()->id,
                'treasuryFrom_id' => $request->treasuryFrom_id,
                'treasuryTo_id' => $request->treasuryTo_id,
                'amount' => $request->amount,
            ]);
            return redirect()->route('treasuryTransfer.create')->with(['success' => "تم التحديث بنجاح"]);
        }
    }

    public function destroy($id)
    {
        $treasuryFrom_id = TreasuryTransfer::where('id', $id)->value('treasuryFrom_id');
        $treasuryTo_id = TreasuryTransfer::where('id', $id)->value('treasuryTo_id');
        $amount = TreasuryTransfer::where('treasuryFrom_id', $treasuryFrom_id)
            ->where('treasuryTo_id', $treasuryTo_id)->value('amount');
        $balanceFrom = Treasury::where('id', $treasuryFrom_id)->value('balance');
        $balanceTo = Treasury::where('id', $treasuryTo_id)->value('balance');
        Treasury::where('id', $treasuryFrom_id)->update([
            'balance' => $balanceFrom + $amount,
        ]);
        Treasury::where('id', $treasuryTo_id)->update([
            'balance' => $balanceTo - $amount,
        ]);

        $treasuryTransfers = TreasuryTransfer::findOrFail($id);
        $treasuryTransfers->delete();
        return redirect()->back()->with(['success' => "تم الحذف بنجاح"]);
    }

    public function treasuryTransferBalanceFromAjax($id)
    {
        $balanceFrom = Treasury::where('delete_at', 0)->where('id', $id)->value('balance');
        return json_encode($balanceFrom);
    }

    public function treasuryTransferBalanceToAjax($id)
    {
        $balanceTo = Treasury::where('delete_at', 0)->where('id', $id)->value('balance');
        return json_encode($balanceTo);
    }
}
