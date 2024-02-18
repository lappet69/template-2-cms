@extends('layouts.app_back')
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
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa-boxes"></i> Identitas</li>
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
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-sm  table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort" style="width: 30px">No</th>
                                <th>Nama Website</th>
                                <th>Nama Gedung (Jika Ada)</th>
                                <th>Alamat Kantor</th>
                                <th>No. Telp</th>
                                <th>No. WA</th>
                                <th>Email</th>
                                <th>Facebook</th>
                                <th>Instagram</th>
                                <th>Linkedin</th>
                                <th>Active</th>
                                <th>Aksi</th>
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
                    url: "{{ route('administrator.identitas.datatable') }}",
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
                        data: 'nama_website',
                        name: 'nama_website'
                    },
                    {
                        data: 'nama_gedung',
                        name: 'nama_gedung'
                    },
                    {
                        data: 'alamat_kantor',
                        name: 'alamat_kantor'
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp'
                    },
                    {
                        data: 'no_wa',
                        name: 'no_wa'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'facebook',
                        name: 'facebook'
                    },
                    {
                        data: 'instagram',
                        name: 'instagram'
                    },
                    {
                        data: 'linkedin',
                        name: 'linkedin'
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
                '<a href="{{ route('administrator.identitas.create') }}" class="btn btn-sm bg-inventory" title="Tambahkan Identitas Website Baru"><i class="fas fa-plus"></i> Tambahkan Identitas Website Baru</a>' +
                '</div>';
            $("div.toolbar").html(toolbar);

            $("#_search").click(() => {
                $('#datatable-all').DataTable().ajax.reload();
            });
        });
    </script>
@endpush
