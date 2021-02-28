<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_member',
        'id_ebook',
        'reason',
        'confirmed',
        'accepted',
        'submit_date',
        'limit_date',
        'reason_for_rejection'
    ];
}
