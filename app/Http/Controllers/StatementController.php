<?php
// app/Http/Controllers/StatementController.php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class StatementController extends Controller
{
    public function checkStatement(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        // Retrieve the member based on the authenticated user or member ID from request
        $member = Member::find($memberId);

        if ($member) {
            // Retrieve loan and contribution details for the member
            $loans = $member->loans()->whereBetween('created_at', [$dateFrom, $dateTo])->get();
            $deposits = $member->deposits()->whereBetween('date_deposited', [$dateFrom, $dateTo])->get();

            // Calculate the percentage loan progress and contribution progress
            $totalLoanProgress = 0;
            $totalContributionProgress = 0;

            foreach ($loans as $loan) {
                $totalLoanProgress += $loan->months_cleared / $loan->payment_period_in_months;
            }

            foreach ($deposits as $deposit) {
                // Calculate contribution progress
            }

            // Calculate the total performance of the whole sacco
            $saccoPerformance = 0;
            // Calculate the total performance

            // Return the statement and performance details
            return response()->json([
                'status' => 'success',
                'message' => 'Statement retrieved successfully',
                'loans' => $loans,
                'deposits' => $deposits,
                'loan_progress' => $totalLoanProgress,
                'contribution_progress' => $totalContributionProgress,
                'sacco_performance' => $saccoPerformance,
            ]);
        }

        // Member not found
        return response()->json([
            'status' => 'error',
            'message' => 'Member not found',
        ], 404);
    }
}
