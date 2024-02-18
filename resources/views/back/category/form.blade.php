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
                                <i class="nav-icon fas fa-eidt"></i> Edit Category
                            @else
                                <i class="nav-icon fas fa-plus"></i> Tambah Category
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Category</li>
                            @if ($model->exists)
                                <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Category</li>
                            @else
                                <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Category</li>
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
                            action="{{ $model->exists ? route('administrator.category.update', base64_encode($model->id)) : route('administrator.category.store') }}"
                            method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if ($model->exists)
                                <input type="hidden" name="_method" value="PUT">
                            @endif

                            <div class="form-group">
                                <label for="title" class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="Title Category"
                                        value="{{ $model->exists ? $model->title : old('title') }}">
                                    @error('title')
                                        <small class="text-red">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subtitle" class="col-sm-12 col-form-label">Sub Title</label>
                                <div class="col-sm-12">
                                    <textarea name="subtitle" rows="5" class="form-control" placeholder="Sub Title Category">{{ $model->exists ? $model->subtitle : old('subtitle') }}</textarea>
                                    @error('subtitle')
                                        <small class="text-red">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
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
            $(function() {
                // Summernote
                $('.summernote').summernote()
            })
        </script>
    @endpush
