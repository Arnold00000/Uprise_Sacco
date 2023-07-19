<?php
// app/Http/Controllers/DepositController.php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function deposit(Request $request)
    {
        $memberId = $request->input('member_id');
        $amount = $request->input('amount');
        $dateDeposited = $request->input('date_deposited');
        $receiptNumber = $request->input('receipt_number');

        // Find the member by member ID
        $member = Member::find($memberId);

        if ($member) {
            // Create a new deposit record
            $deposit = new Deposit();
            $deposit->amount = $amount;
            $deposit->date_deposited = $dateDeposited;
            $deposit->receipt_number = $receiptNumber;

            // Associate the deposit with the member
            $member->deposits()->save($deposit);

            // Deposit successful
            return response()->json([
                'status' => 'success',
                'message' => 'Deposit successful',
            ]);
        }

        // Member not found
        return response()->json([
            'status' => 'error',
            'message' => 'Member not found',
        ], 404);
    }
}
