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
                    <h1 class="m-0"><i class="nav-icon fas fa-boxes"></i> Identitas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-boxes"></i> Identitas</li>
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
                                    value="{{ $model->exists ? $content->nama_website : old('nama_website') }}">
                                @error('nama_website')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="slogan" class="col-sm-12 col-form-label">Slogan</label>
                            <div class="col-sm-12">
                                <input type="text" name="slogan" id="slogan"
                                    class="form-control @error('slogan') is-invalid @enderror"
                                    placeholder="Slogan / Tagline (Jika Ada)"
                                    value="{{ $model->exists ? $content->slogan : old('slogan') }}">
                                @error('slogan')
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
                                    value="{{ $model->exists ? $content->email : old('email') }}">
                                @error('email')
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
                                    class="form-control @error('no_telp') is-invalid @enderror"
                                    placeholder="Misal : +021xxx"
                                    value="{{ $model->exists ? $content->no_telp : old('no_telp') }}">
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
                                    class="form-control @error('no_wa') is-invalid @enderror"
                                    placeholder="Misal : 62813xxxxx"
                                    value="{{ $model->exists ? $content->no_wa : old('no_wa') }}">
                                @error('no_wa')
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
                                    placeholder="Alamat Kantor" rows="5">{{ $model->exists ? $content->alamat_kantor : old('alamat_kantor') }}</textarea>
                                @error('alamat_kantor')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="logo" class="col-sm-12 col-form-label">Logo Institusi<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="logo" id="logo"
                                    class="form-control @error('logo') is-invalid @enderror">
                                @error('logo')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror

                                @php
                                    if ($model->exists) {
                                        echo 'Logo saat ini: <br>';
                                        echo '<img class="img-fluid" style="max-width: 30%;max-height: 30%" src="' .
                                            asset('frontend/assets/img/' . $content->logo) .
                                            '">';
                                    }
                                @endphp
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_description" class="col-sm-12 col-form-label">Deskripsi Singkat</label>
                            <div class="col-sm-12">
                                <textarea name="short_description" rows="5"
                                    class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Misalnya : Gomez and Martines Law Firm and Partners adalah....">{{ $model->exists ? $model->short_description : old('short_description') }}</textarea>
                                @error('short_description')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="facebook" class="col-sm-12 col-form-label">Facebook</label>
                            <div class="col-sm-12">
                                <input type="text" name="facebook" id="facebook"
                                    class="form-control @error('facebook') is-invalid @enderror" placeholder="Facebook"
                                    value="{{ $model->exists ? $content->facebook : old('facebook') }}">
                                @error('facebook')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="twitter" class="col-sm-12 col-form-label">Twitter</label>
                            <div class="col-sm-12">
                                <input type="text" name="twitter" id="twitter"
                                    class="form-control @error('twitter') is-invalid @enderror" placeholder="Twitter"
                                    value="{{ $model->exists ? $content->twitter : old('twitter') }}">
                                @error('twitter')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="youtube" class="col-sm-12 col-form-label">Youtube</label>
                            <div class="col-sm-12">
                                <input type="text" name="youtube" id="youtube"
                                    class="form-control @error('youtube') is-invalid @enderror" placeholder="Youtube"
                                    value="{{ $model->exists ? $content->youtube : old('youtube') }}">
                                @error('youtube')
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
                                    value="{{ $model->exists ? $content->instagram : old('instagram') }}">
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
                                    value="{{ $model->exists ? $content->linkedin : old('linkedin') }}">
                                @error('linkedin')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_title" class="col-sm-12 col-form-label">Meta Title</label>
                            <div class="col-sm-12">
                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control @error('meta_title') is-invalid @enderror"
                                    placeholder="Meta Title"
                                    value="{{ $model->exists ? $content->meta_title : old('meta_title') }}">
                                @error('meta_title')
                                    <small class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="col-sm-12 col-form-label">Meta Description</label>
                            <div class="col-sm-12">
                                <textarea name="meta_description" rows="5"
                                    class="form-control @error('meta_description') is-invalid @enderror" placeholder="Meta Description">{{ $model->exists ? $content->meta_description : old('meta_description') }}</textarea>
                                @error('meta_description')
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
