@extends('layouts.app_back')
@push('css')
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
                            <i class="nav-icon fas fa-eidt"></i> Edit Beasiwa
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Beasiwa
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Beasiwa</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Beasiwa</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Beasiwa</li>
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
                        action="{{ $model->exists ? route('administrator.beasiswa.update', base64_encode($model->id)) : route('administrator.beasiswa.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <label for="title" class="col-sm-12 col-form-label">Title<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                                    value="{{ $model->exists ? $model->title : old('title') }}">
                                @error('title')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subtitle" class="col-sm-12 col-form-label">Sub Title<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="subtitle" id="subtitle" class="form-control"
                                    placeholder="Subtitle"
                                    value="{{ $model->exists ? $model->subtitle : old('subtitle') }}">
                                @error('subtitle')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="course" class="col-sm-12 col-form-label">Course<span class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahCourse"><i
                                        class="fas fa-plus"></i></a></label>

                            @if ($model->exists)
                                @php
                                    $info = explode(',', $model->short_description);
                                @endphp

                                @foreach ($info as $data)
                                    <div class="row mt-1" id="{{ $data }}">
                                        <select name="course[]" class="form-control form-control-sm col-8"
                                            id="course{{ $data }}" data-short-description-id="{{ $data }}">
                                            @foreach ($informasi as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ $info->id == $data ? 'selected' : '' }}>{{ $info->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        &nbsp;<button class="btn btn-xs btn-danger"
                                            onclick="deleteCourse(this,  {{ $data }})">Hapus</button>
                                    </div>
                                @endforeach
                                <div id="list_course">

                                </div>
                            @else
                                <div id="list_course">

                                </div>
                            @endif
                        </div>



                        <div class="form-group">
                            <label for="short_description" class="col-sm-12 col-form-label">Short Description<span
                                    class="text-red">*</span></label>
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
                            <label for="thumbnail" class="col-sm-12 col-form-label">Thumbnail <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                @error('thumbnail')
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

                        <div class="form-group">
                            <label for="informasi" class="col-sm-12 col-form-label">Informasi<span class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahInformasi"><i
                                        class="fas fa-plus"></i></a></label>

                            @if ($model->exists)
                                @php
                                    $info = explode(',', $model->informasi_detail);
                                @endphp

                                @foreach ($info as $data)
                                    <div class="row mt-1" id="{{ $data }}">
                                        <select name="informasi[]" class="form-control form-control-sm col-8"
                                            id="informasi{{ $data }}" data-informasi-id="{{ $data }}">
                                            {{-- @foreach ($informasi as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ $info->id == $data ? 'selected' : '' }}>{{ $info->title }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                        &nbsp;<button class="btn btn-xs btn-danger"
                                            onclick="deleteInformasi(this,  {{ $data }})">Hapus</button>
                                    </div>
                                @endforeach
                                <div id="list_informasi">

                                </div>
                            @else
                                <div id="list_informasi">

                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-sm-12 col-form-label">Value Program<span
                                    class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahCategory"><i
                                        class="fas fa-plus"></i></a></label>
                            @if ($model->exists)
                                @php
                                    $cat = explode(',', $model->category_detail);
                                @endphp

                                @foreach ($cat as $data)
                                    <div class="row mt-1" id="{{ $data }}">
                                        <select name="category[]" class="form-control form-control-sm col-8">
                                            @foreach ($informasi as $info)
                                                <option value="{{ $info->id }}"
                                                    {{ $info->id == $data ? 'selected' : '' }}>{{ $info->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        &nbsp;<button class="btn btn-xs btn-danger"
                                            onclick="deleteCategory(this,  {{ $data }})">Hapus</button>
                                    </div>
                                @endforeach
                                <div id="list_category">

                                </div>
                            @else
                                <div id="list_category">

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
        function deleteCourse(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        function deleteInformasi(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        function deleteCategory(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        $(function() {
            @if ($model->exists)
                @foreach ($info as $data)
                    var informasiId = $('#informasi{{ $data }}').attr('data-informasi-id');

                    fillInformasiId(informasiId, '{{ $data }}')
                @endforeach
            @endif

            $("#tambahCourse").click(function(e) {
                e.preventDefault();
                const d = new Date();
                let norow = d.getTime();
                var list_info = '<div class="row mt-1" id="' + norow + '">' +
                    '               <select name="course[]" class="form-control col-8 select2" id="course' +
                    norow +
                    '">' +
                    '@foreach ($informasi as $item)' +
                    '                           <option value="{{ $item->id }}">{{ $item->title }}</option>' +
                    '@endforeach' +
                    '               </select>' +
                    '               &nbsp;<button class="btn btn-xs btn-danger" onclick="deleteCourse(this, ' +
                    norow + ')">Hapus</button>' +
                    '            </div>';
                $("#list_course").append(list_info);
            })


            $("#tambahInformasi").click(function(e) {
                e.preventDefault();
                const d = new Date();
                let norow = d.getTime();
                var list_info = '<div class="row mt-1" id="' + norow + '">' +
                    '               <select name="informasi[]" class="form-control col-8" id="informasi' +
                    norow + '">' +
                    '               </select>' +
                    '               &nbsp;<button class="btn btn-xs btn-danger" onclick="deleteInformasi(this, ' +
                    norow + ')">Hapus</button>' +
                    '            </div>';
                $("#list_informasi").append(list_info);
                selectInformasi(norow, null);
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

        function selectCourse(norow, params) {
            $('#course' + norow).select2({
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
