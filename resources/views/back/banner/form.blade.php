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
                            <i class="nav-icon fas fa-eidt"></i> Edit Banner
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Banner
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Banner</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Banner</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Banner</li>
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
                        action="{{ $model->exists ? route('administrator.banner.update', base64_encode($model->id)) : route('administrator.banner.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="form-group">
                            <label for="thumbnail" class="col-sm-12 col-form-label">Banner <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="thumbnail[]" id="thumbnail" class="form-control" multiple>
                                @error('thumbnail')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                            @php
                                if ($model->exists) {
                                    echo 'Thumbnail saat ini: <br>';
                                    echo '<img class="img-fluid" src="' . asset('front/assets/img/' . $model->thumbnail) . '">';
                                }
                            @endphp
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Title Banner"
                                    value="{{ $model->exists ? $model->title : old('title') }}">
                                @error('title')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Subtitle</label>
                            <div class="col-sm-12">
                                <input type="text" name="subtitle" id="subtitle" class="form-control"
                                    placeholder="Sub Title Banner"
                                    value="{{ $model->exists ? $model->subtitle : old('subtitle') }}">
                                @error('subtitle')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-sm-12 col-form-label">Deskripsi</label>
                            <div class="col-sm-12">
                                <textarea name="content" class="summernote" rows="5">{{ $model->exists ? $model->content : old('content') }}</textarea>
                                @error('content')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="active" class="col-sm-12 col-form-label">Active <span
                                    class="text-red">*</span></label>
                            <select name="active" id="active"
                                class="form-control @error('active') is-invalid @enderror">
                                <option value="1" {{ $model->exists ? ($model->active == 1 ? 'selected' : '') : '' }}>
                                    Ya</option>
                                <option value="0" {{ $model->exists ? ($model->active == 0 ? 'selected' : '') : '' }}>
                                    Tidak</option>
                            </select>
                            @error('active')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
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
        $(function() {
            // Summernote
            $('.summernote').summernote()
        })
    </script>
@endpush
