<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\Traits\RecordSignature;

class Promo extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;
}
