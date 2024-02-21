@extends('layouts.app_back')
@push('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .point {
            width: 14px;
            height: 14px;
            background: #707071;
            border: 1px solid #707070;
            border-radius: 4px;
            opacity: 1;
        }
    </style>
@endpush
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        @if ($model->exists)
                            <i class="nav-icon fas fa-eidt"></i> Edit Course
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Course
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Course</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Course</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Course</li>
                        @endif
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <form class="form-horizontal"
                        action="{{ $model->exists ? route('administrator.courses.update', base64_encode($model->id)) : route('administrator.courses.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Program<span class="text-red">*
                                </span></label>
                            <div class="col-sm-12">
                                <select name="program" id="program" class="form-control">
                                    @foreach ($program as $p)
                                        <option value="{{ $p->id }}"
                                            {{ $model->exists ? ($model->parent_content_id == $p->id ? 'selected' : '') : '' }}>
                                            {{ $p->title }}</option>
                                    @endforeach
                                </select>
                                @error('title')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Judul Course <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Judul Course" value="{{ $model->exists ? $model->title : old('title') }}">
                                @error('title')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subtitle" class="col-sm-12 col-form-label">Sub Judul Course</label>
                            <div class="col-sm-12">
                                <input type="text" name="subtitle" id="subtitle" class="form-control"
                                    placeholder="Masukkan Sub Title Course"
                                    value="{{ $model->exists ? $model->subtitle : old('subtitle') }}">
                                @error('subtitle')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_description" class="col-sm-12 col-form-label">Deskripsi Singkat</label>
                            <div class="col-sm-12">
                                <textarea name="short_description" rows="5" class="form-control" placeholder="Masukkan Deskripsi Singkat">{{ $model->exists ? $model->short_description : old('short_description') }}</textarea>
                                @error('short_description')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="content" class="col-sm-12 col-form-label">Konten <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <textarea name="content" class="summernote" rows="5">
                                </textarea>
                                @error('content')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label for="gambar" class="col-sm-12 col-form-label">Gambar<span class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahGambar"><i
                                        class="fas fa-plus"></i></a></label>

                            @if ($model->exists)
                                <div id="list_gambar">

                                </div>

                                @php
                                    $asset = \App\Models\Asset::where('content_id', $model->id)->get();
                                @endphp

                                @if (count($asset) > 0)
                                    @foreach ($asset as $a)
                                        <div>
                                            <b>Keterangan Foto Saat ini : </b> {{ $a->keterangan }}<br>
                                            <img class="img-fluid" src="{{ asset('front/assets/img/' . $a->thumbnail) }}"
                                                alt="">
                                            <a href="{{ route('administrator.asset.destroy', ['id' => base64_encode($a->id)]) }}"
                                                class="btn btn-sm btn-danger btn-delete" title="Hapus Asset"><i
                                                    class="fa fa-trash"></i></a>
                                            <br><br>
                                        </div>
                                    @endforeach
                                @endif
                            @else
                                <div id="list_gambar">

                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="informasi" class="col-sm-12 col-form-label">Entri Konten<span
                                    class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahKonten"><i
                                        class="fas fa-plus"></i></a></label>

                            @if ($model->exists)
                                @php
                                    $content = json_decode($model->content, true);
                                @endphp

                                @if (!empty($content['sub_konten']))
                                    @foreach ($content['sub_konten'] as $key => $data)
                                        @php
                                            $norowsubkonten = $data['konten_index'];
                                        @endphp
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="{{ $data['konten_index'] }}">
                                                    <input type="hidden" name="time_id"
                                                        id="time_id{{ $data['konten_index'] }}"
                                                        value="{{ $data['konten_index'] }}">
                                                    <div class="form-group row">
                                                        <label for="konten_title" class="col-sm-12 col-form-label">Judul
                                                            Konten</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="konten_title"
                                                                id="konten_title{{ $norowsubkonten }}"
                                                                value="{{ $data['konten_title'] }}" class="form-control"
                                                                placeholder="Judul Konten">
                                                        </div>
                                                    </div>
                                                    <div class="card card-outline card-info">
                                                        <div class="card-body">
                                                            <div id="{{ $norowsubkonten }}">
                                                                <div class="form-group">
                                                                    <label for="sub_konten_title"
                                                                        class="col-sm-12 col-form-label">Judul Sub
                                                                        Konten</label>
                                                                    <input type="hidden" name="sub_time_id"
                                                                        id="sub_time_id{{ $norowsubkonten }}"
                                                                        value="{{ $data['konten_index'] }}">

                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                            name="sub_konten_title"
                                                                            id="sub_konten_title{{ $norowsubkonten }}"
                                                                            placeholder="Judul">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="sub_konten_upload_image"
                                                                        class="col-sm-12 col-form-label">Upload Image (Jika
                                                                        ada)</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="file"
                                                                            name="sub_konten_upload_image"
                                                                            id="sub_konten_upload_image{{ $norowsubkonten }}"
                                                                            class="form-control"
                                                                            onchange="uploadImage({{ $norowsubkonten }})">
                                                                    </div>
                                                                    <img id="preview-image{{ $norowsubkonten }}"
                                                                        width="300px">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="sub_konten_short_description"
                                                                        class="col-sm-12 col-form-label">Deskripsi
                                                                        Singkat</label>
                                                                    <div class="col-sm-12">
                                                                        <textarea name="sub_konten_short_description" id="sub_konten_short_description{{ $norowsubkonten }}"
                                                                            class="form-control" placeholder="Deskripsi Singkat"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="float-right"><button type="button"
                                                                        class="btn btn-primary"
                                                                        onclick="saveSubContent({{ $norowsubkonten }},{{ $norowsubkonten }})">Tambah
                                                                        Konten</button></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1">
                                                        <table id="FoR_table{{ $data['konten_index'] }}"
                                                            class="table table-sm table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Judul Konten</th>
                                                                    <th>Judul Sub Konten</th>
                                                                    <th>Upload Image</th>
                                                                    <th>Deskripsi Singkat</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="FoR_detail{{ $data['konten_index'] }}">
                                                                @foreach ($data['konten_description'] as $key => $description)
                                                                    <tr id="{{ $description['sub_konten_index'] }}">
                                                                        <td>{{ $data['konten_title'] }}</td>
                                                                        <td>
                                                                            <input type="hidden" name="time_id[]"
                                                                                value="{{ $data['konten_index'] }}">

                                                                            <input type="hidden" name="id[]"
                                                                                value="{{ $data['konten_index'] }}">

                                                                            <input type="hidden" name="content_title[]"
                                                                                value="{{ $data['konten_title'] }}">

                                                                            <input type="hidden"
                                                                                name="sub_content_index[{{ $data['konten_index'] }}][]"
                                                                                value="{{ $description['sub_konten_index'] }}">

                                                                            <input type="hidden"
                                                                                name="sub_content_title[{{ $data['konten_index'] }}][]"
                                                                                value="{{ $description['sub_konten_title'] }}">

                                                                            {{ $description['sub_konten_title'] }}
                                                                        </td>
                                                                        <td>
                                                                            {!! isset($description['sub_konten_image'])
                                                                                ? '<img src="' . asset('front/assets/img/' . $description['sub_konten_image']) . '" width="150px" height="100px">'
                                                                                : '' !!}
                                                                            <input type="hidden"
                                                                                name="sub_content_upload_image[{{ $data['konten_index'] }}][]"
                                                                                value="{{ $description['sub_konten_image'] }}">
                                                                        </td>
                                                                        <td>
                                                                            {{ $description['sub_konten_description'] }}
                                                                            <input type="hidden"
                                                                                name="sub_content_short_description[{{ $data['konten_index'] }}][]"
                                                                                value="{{ $description['sub_konten_description'] }}">
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-xs btn-danger"
                                                                                onClick="deleteFoR(this, {{ $data['konten_index'] }})"><i
                                                                                    class="fas fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="list_informasi">

                                </div>
                            @else
                                <div id="list_informasi">

                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="active" class="col-sm-12 col-form-label">Active <span
                                    class="text-red">*</span></label>
                            <select name="active" id="active" class="form-control">
                                <option value="1"
                                    {{ $model->exists ? ($model->active == 1 ? 'selected' : '') : '' }}>
                                    Ya</option>
                                <option value="0"
                                    {{ $model->exists ? ($model->active == 0 ? 'selected' : '') : '' }}>
                                    Tidak</option>
                            </select>
                        </div>

                        <div class="float-right">
                            <button type="submit" id="save" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Summernote -->
    <script src="{{ asset('back/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('back/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
    <script>
        function deleteGambar2(btn, norow) {
            var row = btn;
            row.parentNode.removeChild(row);
        }

        function deleteGambar(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }


        function deleteKonten(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        function deleteCategory(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Summernote
            $('.summernote').summernote()

            $("#tambahGambar").click(function(e) {
                e.preventDefault();
                const d = new Date();
                let norow = d.getTime();
                var list_gambar = '<div class="row mt-1" id="' + norow + '">' +
                    '               <input type="file" name="gambar[]" class="form-control col-4" id="gambar' +
                    norow + '">&nbsp; <select name="keterangan[]" class="form-control col-2">' +
                    '                       <option value="thumbnail">Thumbnail</option>' +
                    '                       <option value="background_image">Gambar Belakang</option>' +
                    '                  </select>&nbsp;<button class="btn btn-xs btn-danger" onclick="deleteGambar(this, ' +
                    norow + ')">Hapus</button>' +
                    '            </div>';
                $("#list_gambar").append(list_gambar);
            })

            $("#tambahKonten").click(function(e) {
                e.preventDefault();
                const d = new Date();
                let norow = d.getTime();
                let amount = 1;
                let norowsubkonten = d.getTime();
                var list_konten =
                    '     <div class="card">' +
                    '       <div class="card-body">' +
                    '         <div id="' + norow + '">' +
                    '         <form id="uploadForm' + norow + '" enctype="multipart/form-data">' +
                    '           <input type="hidden" name="time_id" id="time_id' + norow + '" value="' +
                    norow + '">' +
                    '           <input type="hidden" name="amount" value="' + amount + '">' +
                    '           <div class="form-group row">' +
                    '             <label for="konten_title" class="col-sm-12 col-form-label">Judul Konten</label>' +
                    '             <div class="col-sm-12">' +
                    '                 <input type="text" name="konten_title" id="konten_title' +
                    norowsubkonten +
                    '" class="form-control" placeholder="Judul Konten">' +
                    '             </div>' +
                    '           </div>' +
                    '           <div class="card card-outline card-info"> ' +
                    '             <div class="card-body">' +
                    '               <div id="' + norowsubkonten + '">' +
                    '                 <div class="form-group">' +
                    '                   <label for="sub_konten_title" class="col-sm-12 col-form-label">Judul Sub Konten</label>' +
                    '                   <input type="hidden" name="sub_time_id" id="sub_time_id" value="' +
                    norow +
                    '">' +
                    '                   <div class="col-sm-12">' +
                    '                       <input type="text" name="sub_konten_title" id="sub_konten_title' +
                    norowsubkonten +
                    '" class="form-control" placeholder="Judul">' +
                    '                   </div>' +
                    '                 </div>' +
                    '                 <div class="form-group">' +
                    '                   <label for="sub_konten_upload_image" class="col-sm-12 col-form-label">Upload Image (Jika ada)</label>' +
                    '                   <div class="col-sm-12">' +
                    '                       <input type="file" name="sub_konten_upload_image" id="sub_konten_upload_image' +
                    norowsubkonten +
                    '" class="form-control" onchange="uploadImage(' +
                    norowsubkonten + ')">' +
                    '                   </div>' +
                    '                   <img id="preview-image' + norowsubkonten + '" width="300px">' +
                    '                 </div>' +
                    '                 <div class="form-group">' +
                    '                   <label for="sub_konten_short_description" class="col-sm-12 col-form-label">Deskripsi Singkat</label>' +
                    '                   <div class="col-sm-12">' +
                    '                       <textarea name="sub_konten_short_description" id="sub_konten_short_description' +
                    norowsubkonten +
                    '" class="form-control" placeholder="Deskripsi Singkat"></textarea>' +
                    '                   </div>' +
                    '                 </div>' +
                    '                 <div class="float-right"><button type="button" class="btn btn-primary" onclick="saveSubContent(' +
                    norowsubkonten + ',' + norow + ')">Tambah Konten</button></div>' +
                    '               </div>' +
                    '             </div>' +
                    '           </div>' +
                    '         </form>' +
                    '         <div class="mt-1">' +
                    '           <table id="FoR_table' + norow +
                    '" class="table table-sm table-bordered table-hover">' +
                    '               <thead>' +
                    '                   <tr>' +
                    '                       <th>Judul Konten</th>' +
                    '                       <th>Judul Sub Konten</th>' +
                    '                       <th>Upload Image</th>' +
                    '                       <th>Deskripsi Singkat</th>' +
                    '                       <th>Aksi</th>' +
                    '                   </tr>' +
                    '               </thead>' +
                    '               <tbody id="FoR_detail' + norow + '">' +
                    '               </tbody>' +
                    '           </table>' +
                    '         </div>' +
                    '         </div>' +

                    '       </div>' +
                    '     </div>';
                $("#list_informasi").append(list_konten);
            })

            $("#tambahCategory").click(function(e) {
                e.preventDefault();
                const d = new Date();
                let norow = d.getTime();
                var list_info = '<div class="row mt-1 id="' + norow + '">' +
                    '               <select name="category[]" class="form-control col-8" id="category' +
                    norow + '">' +
                    '               </select>' +
                    '               &nbsp;<button class="btn btn-xs btn-danger" onclick="deleteCategory(this, ' +
                    norow + ')">Hapus</button>' +
                    '            </div>';
                $("#list_category").append(list_info);
                selectCategory(norow, null);
            })
        })

        function uploadImage(norowsubkonten) {
            var input = $('#sub_konten_upload_image' + norowsubkonten);
            var previewImage = $('#preview-image' + norowsubkonten);
            file = input.prop("files")[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.attr('src', e.target.result);
                    // previewImage.src = e.target.result;
                    // previewContainer.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewContainer.style.display = 'none';
            }
        }

        function saveSubContent(norowsubkonten, norow) {
            var csrfToken = $('#csrf_token').val();
            var formData = new FormData();
            var time_id = $('#time_id' + norow).val();
            var konten_title = $('#konten_title' + norowsubkonten).val();
            var sub_konten_title = $("#sub_konten_title" + norowsubkonten).val();
            var sub_konten_upload_image = $("#sub_konten_upload_image" + norowsubkonten).prop("files")[0];
            var sub_konten_short_description = $("#sub_konten_short_description" + norowsubkonten).val();

            // // Menambahkan token CSRF ke dalam objek FormData
            formData.append('time_id', time_id);
            formData.append('konten_title', konten_title);
            formData.append('sub_konten_title', sub_konten_title);
            formData.append("sub_konten_upload_image", sub_konten_upload_image);
            formData.append('sub_konten_short_description', sub_konten_short_description);

            $.ajax({
                method: 'POST',
                url: "{{ route('administrator.courses.saveSubContent') }}",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: (data) => {
                    $('#sub_konten_title' + norowsubkonten).val('');
                    $('#sub_konten_short_description' + norowsubkonten).val('');
                    $('#sub_konten_upload_image' + norowsubkonten).val('');
                    $('#preview-image' + norowsubkonten).removeAttr('src');
                    $('#FoR_detail' + norow).append(data.row);
                },
                error: (xhr) => {
                    var res = xhr.responseJSON;
                    if ($.isEmptyObject(res) == false) {
                        $.each(res.errors, function(key, value) {
                            var id = $("*[name='" + key + "']").attr('id');
                            $('#' + id)
                                .addClass('is-invalid')
                                .closest('.form-group')
                                .addClass('has-error');

                            $('<span class="help-block invalid-feedback"><strong>' +
                                value + '</strong></span>').insertAfter('#' +
                                id);
                        });
                    }
                }
            });
        }

        function deleteFoR(index, norow) {
            var row = index.parentNode.parentNode.rowIndex;
            document.getElementById('FoR_table' + norow).deleteRow(row);
        }


        function selectInformasi(norow, params) {
            $('#informasi' + norow).select2({
                ajax: {
                    url: '{{ route('administrator.informasi.data') }}',
                    dataType: 'json',
                    data: {
                        q: params
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        }

        function selectCategory(norow, params) {
            $('#category' + norow).select2({
                ajax: {
                    url: '{{ route('administrator.informasi.data') }}',
                    dataType: 'json',
                    data: {
                        q: params
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        }

        function fillInformasiId(informasiId, data) {
            if (informasiId) {
                $.ajax({
                    url: '{{ route('administrator.informasi.getInformasi') }}',
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        informasiId
                    },
                    success: function(data) {
                        $('#informasi' + param).append(data);
                    }
                });
            }
        }
    </script>
@endpush
