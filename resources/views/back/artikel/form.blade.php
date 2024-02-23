@extends('layouts.app_back')
@push('css')
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
                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Judul Artikel <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Judul Artikel" value="{{ $model->exists ? $model->title : old('title') }}">
                                @error('title')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subtitle" class="col-sm-12 col-form-label">Sub Judul Artikel</label>
                            <div class="col-sm-12">
                                <textarea name="subtitle" rows="5" class="form-control" placeholder="Sub Judul Artikel">{{ $model->exists ? $model->subtitle : old('subtitle') }}</textarea>
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
                                <textarea name="short_description" rows="5" class="form-control">{{ $model->exists ? $model->short_description : old('short_description') }}</textarea>
                                @error('short_description')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-sm-12 col-form-label">Konten <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
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
                            <label for="author" class="col-sm-12 col-form-label">Penulis <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="author" id="author" class="form-control"
                                    placeholder="Penulis" value="{{ $model->exists ? $model->author : old('author') }}">
                                @error('author')
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
