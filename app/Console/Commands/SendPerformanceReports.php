<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Replace this with the appropriate User model for your project
use Mail;

class SendPerformanceReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:send-performance-reports';
    protected $signature = 'report:send';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';
    protected $description = 'Send performance reports to all active members';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $activeMembers = User::where('last_deposit_date', '>=', now()->subMonths(6))->get();

        foreach ($activeMembers as $member) {
            $reportData = $this->generatePerformanceReport($member);

            Mail::to($member->email)->send(new PerformanceReportMail($reportData));
        }

        $this->info('Performance reports sent successfully.');
    }

    private function generatePerformanceReport($member)
    {
        // Implement your report generation logic here
        // You can use the $member object to fetch relevant data and generate the report

        // Example: Generate a simple report
        $loanProgress = 60; // Replace this with actual loan progress
        $contributionProgress = 80; // Replace this with actual contribution progress

        $reportData = [
            'member_name' => $member->name,
            'loan_progress' => $loanProgress,
            'contribution_progress' => $contributionProgress,
        ];

        return $reportData;
    }
}
