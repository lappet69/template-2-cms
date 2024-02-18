@extends('layouts.app_back')
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="nav-icon fas fa-boxes"></i> Registrasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><i class="nav-icon fas fa-boxes"></i> Registrasi</li>
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
                    <div class="form-group col-md-6">
                        <label for="name" class="col-sm-12 col-form-label">Tanggal Registrasi</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right daterange" id="tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="col-sm-6">
                            <button class="btn btn-inventory" id="_search"><i class="fas fa-search"></i> Cari
                                Transaksi</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-secondary" id="export"><i class="fas fa-file"></i> Export Data
                        Registrasi</button>
                    <div id="pdfContainer"></div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-sm  table-hover">
                        <thead>
                            <tr>
                                <th class="no-sort" style="width: 30px">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>No. WA</th>
                                <th>Kota Domisili</th>
                                <th>Alamat</th>
                                <th>Program</th>
                                <th>Course</th>
                                {{-- <th>Kuesioner</th> --}}
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
                    url: "{{ route('administrator.registrasi.datatable') }}",
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
                        data: 'nama_ktp',
                        name: 'nama_ktp'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'dob',
                        name: 'dob'
                    },
                    {
                        data: 'no_wa',
                        name: 'no_wa'
                    },
                    {
                        data: 'kota_domisili',
                        name: 'kota_domisili'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'program_id',
                        name: 'program_id'
                    },
                    {
                        data: 'course_id',
                        name: 'course_id'
                    },
                    // {
                    //     data: 'kuesioner',
                    //     name: 'kuesioner'
                    // },
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

            $("#_search").click(() => {
                $('#datatable-all').DataTable().ajax.reload();
            });

            $('#export').click(function() {
                var date = $("#tanggal").val();
                window.location.href = "/administrator/registrasi/export/" + encodeURI(date);
            })
        });
    </script>
@endpush
