<?php
// app/Http/Controllers/LoanController.php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function requestLoan(Request $request)
    {
        $amount = $request->input('amount');
        $paymentPeriodInMonths = $request->input('payment_period_in_months');

        // Validate the request and applicant eligibility
        // For example, check if the member is eligible for a loan based on their contribution history
        // Calculate the available funds in the Sacco
        // Prioritize loan requests based on various factors

        // Generate the loan application number (You can use a unique identifier like UUID)
        $loanApplicationNumber = uniqid('LOAN');

        // Store the loan request in the database or other data storage method
        // You may need to create additional columns in the loans table to store the loan request data

        // Return the response with the loan application number and updates on the loan request process
        return response()->json([
            'status' => 'success',
            'message' => 'Loan request received',
            'application_number' => $loanApplicationNumber,
            'updates' => 'Your loan request is being processed. Please check back later for updates.',
        ]);
    }

    public function loanStatus(Request $request)
    {
        $loanApplicationNumber = $request->input('loan_application_number');

        // Find the loan by application number
        $loan = Loan::where('application_number', $loanApplicationNumber)->first();

        if ($loan) {
            // Check the status of the loan application
            if ($loan->status === 'pending') {
                // The loan application is still pending, provide updates
                return response()->json([
                    'status' => 'success',
                    'message' => 'Loan application status',
                    'loan_status' => 'pending',
                    'updates' => 'Your loan application is still pending. Please check back later for updates.',
                ]);
            } elseif ($loan->status === 'rejected') {
                // The loan application has been rejected
                return response()->json([
                    'status' => 'success',
                    'message' => 'Loan application status',
                    'loan_status' => 'rejected',
                    'updates' => 'Your loan application has been rejected. If you have any questions, please contact us.',
                ]);
            } elseif ($loan->status === 'granted') {
                // The loan application has been granted, display the loan details
                // You may need to add more information to the loans table, such as loan amount and installments

                return response()->json([
                    'status' => 'success',
                    'message' => 'Loan application status',
                    'loan_status' => 'granted',
                    'loan_details' => [
                        'loan_amount' => $loan->amount,
                        'installments' => '...',
                        // Add more details as needed
                    ],
                    'updates' => 'Congratulations! Your loan application has been granted. Please accept or reject the loan.',
                ]);
            }
        }

        // Loan not found or invalid application number
        return response()->json([
            'status' => 'error',
            'message' => 'Loan not found or invalid application number',
        ], 404);
    }

    public function acceptLoan(Request $request)
    {
        $loanApplicationNumber = $request->input('loan_application_number');
        $decision = $request->input('decision'); // 'accept' or 'reject'

        // Find the loan by application number
        $loan = Loan::where('application_number', $loanApplicationNumber)->first();

        if ($loan) {
            if ($decision === 'accept') {
                // Update the loan status to 'taken' and store additional loan details
                // Calculate expected installments and dates and store them in the loans table

                // Return the response with the loan details and confirmation message
                return response()->json([
                    'status' => 'success',
                    'message' => 'Loan accepted',
                    'loan_details' => [
                        'loan_amount' => $loan->amount,
                        'installments' => '...',
                        // Add more details as needed
                    ],
                    'confirmation' => 'Congratulations! You have accepted the loan. Your loan has been registered.',
                ]);
            } elseif ($decision === 'reject') {
                // Update the loan status to 'rejected' and free up the funds for reallocation

                // Return the response with the rejection message
                return response()->json([
                    'status' => 'success',
                    'message' => 'Loan rejected',
                    'reallocated_funds' => 'The funds from your rejected loan have been reallocated to other members.',
                ]);
            }
        }

        // Loan not found or invalid application number
        return response()->json([
            'status' => 'error',
            'message' => 'Loan not found or invalid application number',
        ], 404);
    }
}
