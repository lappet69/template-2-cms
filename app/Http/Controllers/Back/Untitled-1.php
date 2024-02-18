

    {
        "sub_konten_title": "value_of_FoR_title_0",
        "sub_konten_description": "value_of_FoR_description_0"
    },
    {
        "sub_konten_title": "value_of_FoR_title_1",
        "sub_konten_description": "value_of_FoR_description_1"
    },


saya memiliki input seperti ini
$title .= '<input type="hidden" name="konten_title[]" value="' . $title_konten . '">';
$title .= '<input type="hidden" name="sub_konten_index[]" value="' . time() . '">';
$title .= '<input type="hidden" name="sub_konten_title[]" value="' . $title_sub_konten . '">';
$description .= '<input type="hidden" name="sub_konten_description[]" value="' . $short_description_sub_konten . '">';

bagaimana caranya agar saya bisa menghasilkan keluaran output
