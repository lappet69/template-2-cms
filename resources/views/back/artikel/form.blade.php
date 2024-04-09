@extends('layouts.app_back')
@push('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        @if ($model->exists)
                            <i class="nav-icon fas fa-eidt"></i> Edit Artikel
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Artikel
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Artikel</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Artikel</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Artikel</li>
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
                        action="{{ $model->exists ? route('administrator.artikel.update', base64_encode($model->id)) : route('administrator.artikel.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Judul Artikel <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="hidden" name="parent_content_id"
                                    value="{{ base64_encode($parent_content->id) }}">
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Judul Artikel" value="{{ $model->exists ? $model->title : old('title') }}">
                                @error('title')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subtitle" class="col-sm-2 col-form-label">Sub Judul Artikel</label>
                            <div class="col-sm-10">
                                <textarea name="subtitle" rows="5" class="form-control" placeholder="Sub Judul Artikel">{{ $model->exists ? $model->subtitle : old('subtitle') }}</textarea>
                                @error('subtitle')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori_id" class="col-sm-2 col-form-label">Kategori <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <select name="kategori_id" class="form-control col-4 select2bs4">
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}"
                                            {{ $kat->id == $model->kategori_id ? 'selected' : '' }}>
                                            {{ $kat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="short_description" class="col-sm-2 col-form-label">Deskripsi Singkat</label>
                            <div class="col-sm-10">
                                <textarea name="short_description" rows="5" class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Deskripsi Singkat">{{ $model->exists ? $model->short_description : old('short_description') }}</textarea>
                                @error('short_description')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">Konten <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="content" class="summernote" rows="5">
                                    {{ $model->exists ? $model->content : old('content') }}
                                </textarea>
                                @error('content')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gambar" class="col-sm-2 col-form-label">Gambar / Foto / Thumbnail Artikel</label>
                            <div class="col-sm-10">
                                <input type="file" name="gambar" id="gambar"
                                    class="form-control @error('gambar') is-invalid @enderror">
                                @error('gambar')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror

                                @php
                                    if ($model->exists) {
                                        $asset = \App\Models\Asset::where('content_id', $model->id)->first();
                                        if ($asset) {
                                            echo 'Gambar saat ini: <br>';
                                            echo '<img class="img-fluid" src="' .
                                                asset('frontend/assets/img/' . $asset->thumbnail) .
                                                '">';
                                        }
                                    }
                                @endphp
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="author" class="col-sm-2 col-form-label">Penulis <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="author" id="author" class="form-control"
                                    placeholder="Penulis" value="{{ $model->exists ? $model->author : old('author') }}">
                                @error('author')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div> --}}


                        <div class="form-group row">
                            <label for="active" class="col-sm-2 col-form-label">Active <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <select name="active" id="active" class="form-control">
                                    <option value="1"
                                        {{ $model->exists ? ($model->active == 1 ? 'selected' : '') : '' }}>
                                        Ya</option>
                                    <option value="0"
                                        {{ $model->exists ? ($model->active == 0 ? 'selected' : '') : '' }}>
                                        Tidak</option>
                                </select>
                            </div>
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

        $(function() {
            // Summernote
            $('.summernote').summernote()

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

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
        })
    </script>
@endpush
