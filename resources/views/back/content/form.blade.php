@extends('layouts.app_back')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        @if ($model->exists)
                            <i class="nav-icon fas fa-eidt"></i> Edit Konten
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Konten
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Content</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Konten</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Konten</li>
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
                        action="{{ $model->exists ? route('administrator.content.update', base64_encode($model->id)) : route('administrator.content.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <label for="section_id" class="col-sm-12 col-form-label">Section <span
                                    class="text-red">*</span></label>
                            <select class="form-control select2" name="section_id" id="section_id">
                                <option value="">Pilih Section</option>
                                @foreach (App\Models\Section::all() as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>

                            @error('section_id')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="parent_content" class="col-sm-12 col-form-label">Parent Content <span
                                    class="text-red">*</span></label>
                            <select class="form-control select2" name="parent_content_id" id="parent_content_id">
                                <option value="">--Pilih Section - Konten--</option>
                                @foreach ($contents as $content)
                                    <option value="{{ $content->id }}">
                                        {{ $content->section->name . ' - ' . $content->title }}</option>
                                @endforeach
                            </select>

                            @error('parent_content_id')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Judul Konten</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Judul Konten"
                                    value="{{ $model->exists ? $model->title : old('title') }}">
                                @error('title')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subtitle" class="col-sm-12 col-form-label">Sub Judul Konten</label>
                            <div class="col-sm-12">
                                <textarea name="subtitle" rows="5" class="form-control @error('subtitle') is-invalid @enderror"
                                    placeholder="Sub Judul Konten">{{ $model->exists ? $model->subtitle : old('subtitle') }}</textarea>
                                @error('subtitle')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_description" class="col-sm-12 col-form-label">Deskripsi Singkat</label>
                            <div class="col-sm-12">
                                <textarea name="short_description" rows="5" class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Deskripsi Singkat">{{ $model->exists ? $model->short_description : old('short_description') }}</textarea>
                                @error('short_description')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-sm-12 col-form-label">Konten</label>
                            <div class="col-sm-12">
                                <textarea name="content" rows="5" class="summernote @error('content') is-invalid @enderror">{{ $model->exists ? $model->content : old('content') }}</textarea>
                                @error('content')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

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

                                @foreach ($asset as $a)
                                    <div>
                                        <b>Keterangan Foto Saat ini : </b> {{ $a->keterangan }}<br>
                                        <img class="img-fluid" src="{{ asset('front/assets/img/' . $a->thumbnail) }}"
                                            alt=""><br><br>
                                    </div>
                                @endforeach
                            @else
                                <div id="list_gambar">

                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-sm-12 col-form-label">Category<span
                                    class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahCategory"><i
                                        class="fas fa-plus"></i></a></label>
                            <div id="list_category">

                            </div>
                        </div>



                        <div class="form-group">
                            <label for="description" class="col-sm-12 col-form-label">Deskripsi</label>
                            <div class="col-sm-12">
                                <textarea name="description" rows="5" class="summernote">{{ $model->exists ? $model->description : old('description') }}</textarea>
                                @error('description')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
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
    <!-- Select2 -->
    <script src="{{ asset('back/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('back/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        function deleteGambar(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        function deleteCategory(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        $(function() {
            $('.select2').select2();

            // Summernote
            $('.summernote').summernote()

            $("#tambahGambar").click(function(e) {
                e.preventDefault();
                const d = new Date();
                let norow = d.getTime();
                var list_gambar = '<div class="row mt-1" id="' + norow + '">' +
                    '               <input type="file" name="gambar[]" class="form-control col-4" id="gambar' +
                    norow + '">&nbsp;' +
                    '<select name="keterangan[]" class="form-control col-2">' +
                    '<option value="thumbnail">Thumbnail</option>' +
                    '<option value="background_image">Gambar Belakang</option>' +
                    '</select>&nbsp;' +
                    '<button class="btn btn-xs btn-danger" onclick="deleteGambar(this, ' +
                    norow + ')">Hapus</button>' +
                    '            </div>';
                $("#list_gambar").append(list_gambar);
            })

            $("#tambahCategory").click(function(e) {
                const d = new Date();
                let norow = d.getTime();
                var list_category = '<div class="row mt-1 id="' + norow + '">' +
                    '               <input type="text" class="form-control form-control-sm col-8" name="info[]" placeholder="Info">' +
                    '               &nbsp;<button class="btn btn-xs btn-danger" onclick="deleteCategory(this, ' +
                    norow + ')">Hapus</button>' +
                    '            </div>';
                $("#list_category").append(list_category);
            })

        })
    </script>
@endpush
