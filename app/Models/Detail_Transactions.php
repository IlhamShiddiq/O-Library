<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Transactions extends Model
{
    use HasFactory;

    protected $table = "detail_transactions";

    protected $fillable = [
        'transaction_id',
        'book_id',
        'date_of_return',
        'status',
        'last_warned'
    ];
}
