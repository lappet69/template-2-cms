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
                            <i class="nav-icon fas fa-eidt"></i> Edit Identitas
                        @else
                            <i class="nav-icon fas fa-plus"></i> Tambah Identitas
                        @endif
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Identitas</li>
                        @if ($model->exists)
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-edit"></i> Edit Identitas</li>
                        @else
                            <li class="breadcrumb-item active"><i class="nav-icon fas fa-plus"></i> Tambah Identitas</li>
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
                        action="{{ $model->exists ? route('administrator.identitas.update', base64_encode($model->id)) : route('administrator.identitas.store') }}"
                        method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($model->exists)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <label for="nama_website" class="col-sm-12 col-form-label">Nama Website</label>
                            <div class="col-sm-12">
                                <input type="text" name="nama_website" id="nama_website"
                                    class="form-control @error('nama_website') is-invalid @enderror"
                                    placeholder="Nama Website"
                                    value="{{ $model->exists ? $model->nama_website : old('nama_website') }}">
                                @error('nama_website')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_gedung" class="col-sm-12 col-form-label">Nama Gedung</label>
                            <div class="col-sm-12">
                                <input type="text" name="nama_gedung" id="nama_gedung"
                                    class="form-control @error('nama_gedung') is-invalid @enderror"
                                    placeholder="Nama Gedung"
                                    value="{{ $model->exists ? $model->nama_gedung : old('nama_gedung') }}">
                                @error('nama_gedung')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_kantor" class="col-sm-12 col-form-label">Alamat Kantor</label>
                            <div class="col-sm-12">
                                <textarea name="alamat_kantor" class="form-control @error('alamat_kantor') is-invalid @enderror"
                                    placeholder="Alamat Kantor" rows="5">{{ $model->exists ? $model->alamat_kantor : old('alamat_kantor') }}</textarea>
                                @error('alamat_kantor')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_telp" class="col-sm-12 col-form-label">No. Telp</label>
                            <div class="col-sm-12">
                                <input type="text" name="no_telp" id="no_telp"
                                    class="form-control @error('no_telp') is-invalid @enderror" placeholder="No. Telp"
                                    value="{{ $model->exists ? $model->no_telp : old('no_telp') }}">
                                @error('no_telp')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_wa" class="col-sm-12 col-form-label">No. WA</label>
                            <div class="col-sm-12">
                                <input type="text" name="no_wa" id="no_wa"
                                    class="form-control @error('no_wa') is-invalid @enderror" placeholder="No. WA"
                                    value="{{ $model->exists ? $model->no_wa : old('no_wa') }}">
                                @error('no_wa')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-12 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ $model->exists ? $model->email : old('email') }}">
                                @error('email')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="img_address_1" class="col-sm-12 col-form-label">Gambar Lokasi Bootcamp 1<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="img_address_1" id="img_address_1"
                                    class="form-control @error('img_address_1') is-invalid @enderror">
                                @error('img_address_1')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror

                                @php
                                    if ($model->exists) {
                                        echo 'Thumbnail saat ini: <br>';
                                        echo '<img class="img-fluid" src="' . asset('front/assets/img/' . $model->img_address_1) . '">';
                                    }
                                @endphp
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="img_address_2" class="col-sm-12 col-form-label">Gambar Lokasi Bootcamp 2<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="img_address_2" id="img_address_2"
                                    class="form-control @error('img_address_2') is-invalid @enderror">
                                @error('img_address_2')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror

                                @php
                                    if ($model->exists) {
                                        echo 'Thumbnail saat ini: <br>';
                                        echo '<img class="img-fluid" src="' . asset('front/assets/img/' . $model->img_address_2) . '">';
                                    }
                                @endphp
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="img_address_3" class="col-sm-12 col-form-label">Gambar Lokasi Bootcamp 3<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="img_address_3" id="img_address_3"
                                    class="form-control @error('img_address_3') is-invalid @enderror">
                                @error('img_address_3')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror

                                @php
                                    if ($model->exists) {
                                        echo 'Thumbnail saat ini: <br>';
                                        echo '<img class="img-fluid" src="' . asset('front/assets/img/' . $model->img_address_3) . '">';
                                    }
                                @endphp
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="facebook" class="col-sm-12 col-form-label">Facebook</label>
                            <div class="col-sm-12">
                                <input type="text" name="facebook" id="facebook"
                                    class="form-control @error('facebook') is-invalid @enderror" placeholder="Facebook"
                                    value="{{ $model->exists ? $model->facebook : old('facebook') }}">
                                @error('facebook')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="instagram" class="col-sm-12 col-form-label">Instagram</label>
                            <div class="col-sm-12">
                                <input type="text" name="instagram" id="instagram"
                                    class="form-control @error('instagram') is-invalid @enderror" placeholder="Instagram"
                                    value="{{ $model->exists ? $model->instagram : old('instagram') }}">
                                @error('instagram')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkedin" class="col-sm-12 col-form-label">Linkedin</label>
                            <div class="col-sm-12">
                                <input type="text" name="linkedin" id="linkedin"
                                    class="form-control @error('linkedin') is-invalid @enderror" placeholder="Linkedin"
                                    value="{{ $model->exists ? $model->linkedin : old('linkedin') }}">
                                @error('linkedin')
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
                                <option value="1"
                                    {{ $model->exists ? ($model->active == 1 ? 'selected' : '') : (old('active') == 1 ? 'selected' : '') }}>
                                    Ya</option>
                                <option value="0"
                                    {{ $model->exists ? ($model->active == 0 ? 'selected' : '') : (old('active') == 0 ? 'selected' : '') }}>
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
        function deleteCategory(btn, norow) {
            var row = btn.parentNode;
            row.parentNode.removeChild(row);
        }

        $(function() {
            // Summernote
            $('.summernote').summernote()
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

            $('.select2').select2()


        })
    </script>
@endpush
