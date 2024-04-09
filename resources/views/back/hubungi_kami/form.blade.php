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
                    <h1 class="m-0"><i class="nav-icon fas fa-users"></i> Hubungi Kami</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-users"></i> Hubungi Kami</li>
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
                        action="{{ $model->exists ? route('administrator.hubungi-kami.update', base64_encode($model->id)) : route('administrator.hubungi-kami.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Judul Konten<span
                                    class="text-red">*</span></label>
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
                                <input type="text" name="subtitle" id="subtitle"
                                    class="form-control @error('subtitle') is-invalid @enderror"
                                    placeholder="Sub Judul Konten"
                                    value="{{ $model->exists ? $model->subtitle : old('subtitle') }}">
                                @error('subtitle')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Lokasi Kantor pada Peta <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <div class="row">
                                    <input type="text" name="latitude" id="latitude"
                                        class="form-control col-4 mr-2 @error('latitude') is-invalid @enderror"
                                        placeholder="Latitude"
                                        value="{{ $model->exists ? $content->latitude : old('latitude') }}">
                                    <input type="text" name="longitude" id="longitude"
                                        class="form-control col-4  @error('longitude') is-invalid @enderror"
                                        placeholder="Longitude"
                                        value="{{ $model->exists ? $content->longitude : old('longitude') }}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="content" class="col-sm-12 col-form-label">Informasi Hubungi Kami</label>
                            <div class="col-sm-12">
                                <textarea name="content" class="summernote @error('content') is-invalid @enderror" rows="5">
                                    {{ $model->exists ? $model->content : old('content') }}
                                </textarea>
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
        })
    </script>
@endpush
