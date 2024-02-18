@extends('layouts.app_back')
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        @if ($model->exists)
                            <i class="nav-icon fas fa-eidt"></i> Edit Kuesioner
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Kuesioner
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Kuesioner</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Kuesioner</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Kuesioner</li>
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
                        action="{{ $model->exists ? route('administrator.kuesioner.update', base64_encode($model->id)) : route('administrator.kuesioner.store') }}"
                        method="POST">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="form-group">
                            <label for="pertanyaan" class="col-sm-12 col-form-label">Title <span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="pertanyaan" id="pertanyaan" class="form-control"
                                    placeholder="Masukkan Pertanyaan Kuesioner"
                                    value="{{ $model->exists ? $model->pertanyaan : old('pertanyaan') }}">
                                @error('pertanyaan')
                                    <small class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jawaban" class="col-sm-12 col-form-label">Opsi Jawaban Kuesioner<span
                                    class="text-red">*</span>
                                <a href="javascript:void(0)" class="btn btn-xs btn-inventory" id="tambahJawaban"><i
                                        class="fas fa-plus"></i></a></label>

                            @if ($model->exists)
                                @php
                                    $opsi = json_decode($model->opsi_jawaban);

                                @endphp
                                @foreach ($opsi as $key => $data)
                                    <div class="row mt-1" id="{{ $key }}">
                                        <input type="hidden" name="id[]" value="{{ $key }}">
                                        <input name="jawaban[]" class="form-control form-control-sm col-8"
                                            id="jawaban{{ $key }}" data-jawaban-id="{{ $key }}"
                                            value="{{ $data }}">
                                        &nbsp;<button class="btn btn-xs btn-danger"
                                            onclick="deleteJawaban(this,  {{ $key }})">Hapus</button>
                                    </div>
                                @endforeach
                                <div id="list_jawaban">

                                </div>
                            @else
                                <div id="list_jawaban">

                                </div>
                            @endif
                        </div>

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
    <script>
        function deleteJawaban(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        $(function() {
            $("#tambahJawaban").click(function(e) {
                e.preventDefault();
                const d = new Date();
                let norow = d.getTime();
                var list_info = '<div class="row mt-1" id="' + norow + '">' +
                    '       <input type="hidden" name="id[]" value="' + norow + '">' +
                    '               <input name="jawaban[]" class="form-control form-control-sm col-8" id="jawaban' +
                    norow + '" placeholder="Masukkan Jawaban Kuesioner">' +
                    '               &nbsp;<button class="btn btn-xs btn-danger" onclick="deleteJawaban(this, ' +
                    norow + ')">Hapus</button>' +
                    '            </div>';
                $("#list_jawaban").append(list_info);
            })
        })
    </script>
@endpush
