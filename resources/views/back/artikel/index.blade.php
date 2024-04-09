@extends('layouts.app_back')
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="nav-icon fas fa-boxes"></i> Artikel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa-boxes"></i> Artikel</li>
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

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Judul Konten<span
                                    class="text-red">*</span></label>
                            <div class="col-sm-10">
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

                        <div class="form-group row">
                            <label for="subtitle" class="col-sm-2 col-form-label">Sub Judul Konten</label>
                            <div class="col-sm-10">
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

                        <div class="form-group row">
                            <label for="short_description" class="col-sm-2 col-form-label">Deskripsi Singkat</label>
                            <div class="col-sm-10">
                                <textarea name="short_description" placeholder="Deskripsi Singkat"
                                    class="form-control @error('short_description') is-invalid @enderror" rows="2">{{ $model->exists ? $model->short_description : old('short_description') }}</textarea>
                                @error('short_description')
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-sm  table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort" style="width: 30px">No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Foto</th>
                                <th>Slug</th>
                                <th>Views</th>
                                <th>Penulis</th>
                                <th>Aktif</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#datatable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                cache: false,
                ajax: {
                    url: "{{ route('administrator.artikel.datatable') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        return $.extend({}, d, {
                            // name: $("#_name").val(),
                            // email: $("#_email").val(),
                            // role_id: $("#_role_ids").val()
                        });
                    }
                },
                dom: '<"toolbar">lfrtip',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'kategori_id',
                        name: 'kategori_id'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'counter',
                        name: 'counter'
                    },
                    {
                        data: 'author',
                        name: 'author'
                    },
                    {
                        data: 'active',
                        name: 'active'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                columnDefs: [{
                    "targets": 'no-sort',
                    "orderable": false,
                }],
                order: [
                    [1, "asc"]
                ]
            });

            const toolbar = '<div class="dt-buttons btn-group flex-wrap">' +
                '<a href="{{ route('administrator.artikel.create') }}" class="btn btn-sm bg-inventory" title="Tambahkan Artikel Baru"><i class="fas fa-plus"></i> Tambahkan Artikel Baru</a>' +
                '</div>';
            $("div.toolbar").html(toolbar);

            $("#_search").click(() => {
                $('#datatable-all').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
