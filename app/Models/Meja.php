<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table ="Meja";

    use HasFactory;

    protected $fillable = ['id', 'currently_active', 'nomor_meja'];
}
