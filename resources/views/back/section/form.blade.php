@extends('layouts.app_back')
@push('css')
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
                            <i class="nav-icon fas fa-eidt"></i> Edit Section
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Section
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Section</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Section</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Section</li>
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
                        action="{{ $model->exists ? route('administrator.section.update', base64_encode($model->id)) : route('administrator.section.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="form-group">
                            <label for="name" class="col-sm-12 col-form-label">Nama Section <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror " placeholder="Nama Section"
                                    value="{{ $model->exists ? $model->name : old('name') }}">
                                @error('name')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Parent Section<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <select name="parent_section_id" id="parent_section_id" class="form-control select2bs4">
                                    <option value="">-Tidak Ada-</option>
                                    @foreach ($parent_section as $p)
                                        <option value="{{ $p->id }}"
                                            {{ $model->exists ? ($model->parent_section_id == $p->id ? 'selected' : '') : '' }}>
                                            {{ $p->name }}</option>
                                    @endforeach
                                </select>
                                @error('title')
                                    <small class="invalid-feedback">
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
    <!-- Select2 -->
    <script src="{{ asset('back/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endpush
