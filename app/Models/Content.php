<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\Traits\RecordSignature;

class Content extends Model
{
    use HasFactory, SoftDeletes, RecordSignature;

    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'section_id');
    }

    public function childcontent()
    {
        return $this->hasMany(Content::class, 'parent_content_id', 'id');
    }

    public function asset()
    {
        return $this->hasMany(Asset::class, 'id', 'content_id');
    }
}
