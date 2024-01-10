<?php

// app/Models/Voucher.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = ['code', 'amount', 'expired_at', 'is_used', 'used_at'];

    // Define relationships or additional methods as needed
}
