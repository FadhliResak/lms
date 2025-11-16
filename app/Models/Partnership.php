<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_name',
        'agreement_title',
        'start_date',
        'end_date',
        'notes',
    ];
}
