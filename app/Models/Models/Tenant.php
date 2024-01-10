<?php

// app/Models/Tenant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name', 'description'];

    // Define relationships or additional methods as needed
}
