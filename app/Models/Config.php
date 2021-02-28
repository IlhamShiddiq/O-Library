<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'late_charge',
        'loan_deadline',
        'book_list_page',
        'member_list_page',
        'librarian_list_page',
        'ebook_list_page',
        'publisher_list_page',
        'category_list_page',
        'permission_list_page',
        'transaction_list_page',
        'report_list_page',
        'bg_member'
    ];
}
