<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Content {
    public static function listCourse($where,$where2) {
        return DB::select("
            SELECT
            child.id, child.title, child.active, child.counter, parent.title AS program
            FROM
            contents AS child
            LEFT JOIN contents AS parent ON child.parent_content_id = parent.id
            WHERE child.section_id='" . $where . "'
            AND child.deleted_at IS NULL
            AND child.parent_content_id IN (SELECT contents.id FROM contents JOIN sections ON contents.section_id=sections.id
            WHERE sections.slug='" . $where2 . "'
            AND contents.deleted_at IS NULL AND sections.deleted_at IS NULL)
        ");
    }

    public static function listClient($where) {
        return DB::select("
            SELECT
            assets.id, assets.thumbnail, contents.title
            FROM
            assets
            LEFT JOIN contents ON assets.content_id = contents.id
            WHERE contents.section_id = '".$where."'
            AND assets.deleted_at IS NULL AND contents.deleted_at IS NULL
            ORDER BY assets.id ASC
        ");
    }
}