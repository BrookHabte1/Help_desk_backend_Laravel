<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class email extends Model
{
    use HasFactory;

    protected $table = "emails";

    protected $fillable = [
        "ContactPersonName",
        "Email",
        "CompanyName",
        "PhoneNumber",
    ];
};
