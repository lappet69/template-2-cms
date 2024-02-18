<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\Traits\RecordSignature;

class Kuesioner extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    public function opsijawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_pertanyaan', 'id');
    }
}