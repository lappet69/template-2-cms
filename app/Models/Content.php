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

    public function _created()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function parentcontent()
    {
        return $this->belongsTo(Content::class, 'parent_content_id', 'id');
    }

    public function childcontent()
    {
        return $this->hasMany(Content::class, 'parent_content_id', 'id');
    }

    public function childlawyer()
    {
        return $this->hasMany(Content::class, 'parent_content_id', 'id')->limit(4);
    }

    public function childareapraktek()
    {
        return $this->hasMany(Content::class, 'parent_content_id', 'id')->limit(4);
    }

    public function childartikel()
    {
        return $this->hasMany(Content::class, 'parent_content_id', 'id')->limit(3);
    }

    

    public function asset()
    {
        return $this->hasOne(Asset::class, 'content_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'subtitle', 'id');
    }

}
