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
                            <i class="nav-icon fas fa-eidt"></i> Edit About
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah About
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> About</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit About</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah About</li>
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
                        action="{{ $model->exists ? route('administrator.about') : route('administrator.about') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <label for="background_about" class="col-sm-12 col-form-label">Background About <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="background_about" id="background_about" class="form-control">
                                @error('background_about')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror

                                @php
                                    if ($about->exists) {
                                        echo 'Thumbnail saat ini: <br>';
                                        echo '<img class="img-fluid" src="' . asset('front/assets/img/' . $model->thumbnail) . '">';
                                    }
                                @endphp
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Title <span
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
                            <label for="subtitle" class="col-sm-12 col-form-label">Subtitle</label>
                            <div class="col-sm-12">
                                <textarea name="subtitle" rows="5" class="summernote">
                                    {{ $model->exists ? $model->subtitle : old('subtitle') }}
                                </textarea>
                                @error('subtitle')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_description" class="col-sm-12 col-form-label">Short Deskripsi</label>
                            <div class="col-sm-12">
                                <textarea name="short_description" rows="5" class="summernote">
                                    {{ $model->exists ? $model->short_description : old('short_description') }}
                                </textarea>
                                @error('short_description')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-sm-12 col-form-label">Content <span
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
                            <label for="image" class="col-sm-12 col-form-label">Thumbnail <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror

                                @php
                                    if ($model->exists) {
                                        echo 'Thumbnail saat ini: <br>';
                                        echo '<img class="img-fluid" src="' . asset('front/assets/img/' . $model->thumbnail) . '">';
                                    }
                                @endphp
                            </div>
                        </div>


                        {{-- <div class="form-group">
                            <label for="category" class="col-sm-12 col-form-label">Category<span class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahCategory"><i
                                        class="fas fa-plus"></i></a></label>
                            <div id="list_category">

                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label for="active" class="col-sm-12 col-form-label">Active <span
                                    class="text-red">*</span></label>
                            <select name="active" id="active" class="form-control">
                                <option value="1" {{ $model->exists ? ($model->active == 1 ? 'selected' : '') : '' }}>
                                    Ya</option>
                                <option value="0" {{ $model->exists ? ($model->active == 0 ? 'selected' : '') : '' }}>
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
        $(function() {
            // Summernote
            $('.summernote').summernote()
        })
    </script>
@endpush
