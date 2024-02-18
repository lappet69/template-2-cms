@extends('layouts.app_register')

@section('content')
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            <div class="card card-registration m-0">
                <div class="row g-0">
                    <div class="col-lg-6 col-xl-6">
                        <img src="{{ asset('front/assets/img/register-bg.png') }}" alt="Sample photo"
                            class="img-fluid img-register d-lg-block d-md-none d-sm-none d-none" />
                    </div>
                    <div class="col-lg-6 col-xl-6 registration-form">
                        <div class="container-register">
                            <div class="card-body">
                                <div class="registration-title">
                                    <h1 class="mb-5">Halaman Registrasi</h1>
                                    <a href="{{ route('index') }}">
                                        <p class="back-to-home mb-5">Back to Home</p>
                                    </a>
                                </div>
                                <div class="row registration-type d-lg-flex d-md-flex">
                                    <div class="col registration-instruction mb-3">
                                        <p>
                                            <span>Pilihan Program</span><br />
                                            Pertama-tama pilihlah salah satu program di samping.
                                        </p>
                                        <a class="btn">Panduan Program</a>
                                    </div>
                                    @foreach ($program as $p)
                                        <button
                                            class="col-12 col-md-6 col-lg-3 registration-offline d-flex justify-content-center align-items-center"
                                            id="program{{ $p->id }}" onclick="courseSelection({{ $p->id }})">
                                            <p>{{ $p->title }}</p>
                                        </button>
                                    @endforeach
                                </div>
                                <div class="registration-body">

                                    <form action="{{ route('registrasi.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <input class="form-control @error('program_id') is-invalid @enderror"
                                                        type="hidden" name="program_id" id="program_id">
                                                    @error('program_id')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="course_type">Pilihan Course</label>
                                                    <select class="form-select @error('course_type') is-invalid @enderror"
                                                        name="course_type" id="course_type">
                                                        <option value="">-Pilih Course-</option>
                                                    </select>
                                                    @error('course_type')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="nama_ktp">Nama Sesuai KTP</label>
                                                    <input type="text" id="nama_ktp"
                                                        class="form-control @error('nama_ktp') is-invalid @enderror"
                                                        name="nama_ktp" value="{{ old('nama_ktp') }}" />
                                                    @error('nama_ktp')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="email">Alamat Email</label>
                                                    <input type="email" id="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" />
                                                    @error('email')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="gender">Jenis Kelamin</label>
                                                    <select class="form-select @error('gender') is-invalid @enderror"
                                                        name="gender" id="gender">
                                                        <option value="">-Pilih Jenis Kelamin-</option>
                                                        <option value="male"
                                                            {{ old('gender') == 'male' ? 'selected' : '' }}>Pria</option>
                                                        <option value="female"
                                                            {{ old('gender') == 'female' ? 'selected' : '' }}>Wanita
                                                        </option>
                                                    </select>

                                                    @error('gender')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="dob">Tanggal Lahir</label>
                                                    <input type="date" id="dob"
                                                        class="form-control @error('dob') is-invalid @enderror"
                                                        name="dob" value="{{ old('dob') }}" />

                                                    @error('dob')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="no_wa">No. HP (WhatsApp)</label>
                                                    <input type="text" id="no_wa"
                                                        class="form-control @error('no_wa') is-invalid @enderror"
                                                        name="no_wa" value="{{ old('no_wa') }}" />

                                                    @error('no_wa')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="kota_domisili">Kota Domisili</label>
                                                    <select class="form-select @error('kota_domisili') is-invalid @enderror"
                                                        id="kota_domisili" name="kota_domisili"
                                                        value="{{ old('kota_domisili') }}">
                                                        <option value="">-Pilih Kota Domisili-</option>
                                                        <option value="jakarta"
                                                            {{ old('kota_domisili') == 'jakarta' ? 'selected' : '' }}>
                                                            Jakarta
                                                        </option>
                                                        <option value="bandung"
                                                            {{ old('kota_domisili') == 'bandung' ? 'selected' : '' }}>
                                                            Bandung
                                                        </option>
                                                    </select>

                                                    @error('kota_domisili')
                                                        <small class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label" for="alamat">Address</label>
                                                <textarea name="alamat" id="alamat" cols="30" rows="10"
                                                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>

                                                @error('alamat')
                                                    <small class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between pt-3">
                                            <input type="reset" class="btn btn-cancel-x btn-light" value="X Reset">
                                            <button type="button" class="btn btn-register-x btn-next"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-regular-register">Lanjutkan</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-regular-register" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body modal-register-body">
                                                            @foreach ($kuesioner as $kue)
                                                                <div class="modal-register-form-group">
                                                                    <label class="modal-register-label">
                                                                        <span
                                                                            style="color: #ff0000">*</span>{{ $kue->pertanyaan }}
                                                                        <input type="hidden"
                                                                            name="pertanyaan{{ $kue->id }}"
                                                                            value="{{ $kue->pertanyaan }}">
                                                                    </label>
                                                                    @if (isset($kue->opsi_jawaban))
                                                                        @php
                                                                            $opsi = json_decode($kue->opsi_jawaban);
                                                                        @endphp

                                                                        @foreach ($opsi as $key => $op)
                                                                            @php
                                                                                $checked = old('jawaban' . $kue->id) == $op ? 'checked' : '';
                                                                            @endphp
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="radio"
                                                                                    name="jawaban{{ $kue->id }}"
                                                                                    id="{{ $key }}"
                                                                                    value="{{ $op }}"
                                                                                    {{ $checked }} />
                                                                                <label class="form-check-label"
                                                                                    for="{{ $op }}">
                                                                                    {{ $op }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                            <div class="modal-register-form-group">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="confirm"
                                                                        type="checkbox" value="1" id="confirm" />
                                                                    <label class="form-check-label" for="confirm">
                                                                        Dengan mengirim formulir ini saya
                                                                        menyetujui Syarat dan Ketentuan untuk
                                                                        mengikuti program yang saya daftarkan.
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Kembali
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Lanjutkan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var id = '{{ old('program_id') }}';
            if (id) {
                $("#program" + id).css({
                    "background": "#0071ce",
                    "color": "#fff",
                })
            } else {
                id = 0;
            }
            courseSelection(id)
        })

        function courseSelection(id) {
            $(".registration-offline").css({
                "color": "#0071ce",
                "background": "#ffffff"
            });

            $("#program" + id).css({
                "background": "#0071ce",
                "color": "#fff",
            })
            $('#program_id').attr("value", id);
            $.ajax({
                url: '{{ route('getCourse') }}',
                method: 'post',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                },
                success: function(data) {
                    var selected = '{{ old('course_type') }}';
                    var str_data = '<option value="">-Pilih Course-</option>';
                    str_data += data.map((response) => {
                        var select = selected == response.id ? 'selected' : '';
                        return '<option value="' + response.id + '"' + select + '>' +
                            response.title + '</option>';
                    });
                    $('#course_type').html(str_data);
                },
                error: function(xhr) {
                    console.log(xhr);
                    // var res = xhr.responseJSON;
                    // if (res.message != '') {

                    // }
                    // console.log(res.errors)
                    // if ($.isEmptyObject(res.errors) == false) {
                    //     $.each(res.errors, function(key, value) {
                    //         $('#' + key)
                    //             .closest('.form-control')
                    //             .addClass('is-invalid')
                    //         $('<span class="invalid-feedback" role="alert"><strong>' + value +
                    //             '</strong></span>').insertAfter($('#' + key))
                    //     });
                    // }

                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Something went wrong!',
                    //     text: 'Check your values',
                    //     confirmButtonColor: '#3085d6',
                    // });

                }
            })

        }
    </script>
@endpush
