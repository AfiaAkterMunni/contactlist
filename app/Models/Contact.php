<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'company', 'phone', 'mobile', 'address', 'country', 'website', 'category_id', 'created_by'];
}
