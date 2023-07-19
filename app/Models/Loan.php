<?php
// app/Models/Loan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['amount', 'payment_period_in_months', 'status'];

    // Define relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
