<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\Traits\RecordSignature;

class Jawaban extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    protected $fillable = ['id_pertanyaan','jawaban'];
}