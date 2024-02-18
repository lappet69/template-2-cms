@extends('layouts.app_register')

@section('content')
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            <div class="card card-registration">
                <div class="row g-0">
                    <div class="col-12 col-md-6 col-xl-6">
                        <img src="{{ asset('front/assets/img/register-bg.png') }}" alt="Sample photo"
                            class="img-fluid img-register" />
                    </div>
                    <div class="col-12 col-md-6 col-xl-6 registration-form">
                        <div class="container-register">
                            <div class="card-body">
                                <div class="registration-title">
                                    <h1>Program Beasiswa</h1>
                                    <p>Back to Home</p>
                                </div>
                                <div class="registration-body">
                                    <div class="row">
                                        <div class="col-md-6 registration-fill">
                                            <label class="form-label" for="form3Example1m">Pilihan Course</label>
                                            <select class="form-control" name="course_type">
                                                <option value="1">-Select Course-</option>
                                                <option value="2">Option 1</option>
                                                <option value="3">Option 2</option>
                                                <option value="4">Option 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 registration-fill">
                                            <div class="form-group">
                                                <label class="form-label" for="nama_ktp">Nama Sesuai KTP</label>
                                                <input type="text" id="nama_ktp" class="form-control" name="nama_ktp" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 registration-fill">
                                            <div class="form-outline">
                                                <label class="form-label" for="email">Alamat Email</label>
                                                <input type="text" id="email" class="form-control" name="email" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 registration-fill">
                                            <div class="form-group">
                                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                                <select class="form-control" name="gender">
                                                    <option value="3">-Select Gender-</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 registration-fill">
                                            <div class="form-outline">
                                                <label class="form-label" for="dob">Tanggal Lahir</label>
                                                <input type="date" id="dob" class="form-control" name="dob" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 registration-fill">
                                            <div class="form-group">
                                                <label class="form-label" for="gender">No. HP (WhatsApp)</label>
                                                <input type="text" id="no_wa" class="form-control" name="no_wa" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 registration-fill">
                                            <div class="form-outline">
                                                <label class="form-label" for="email">Kota Domisili</label>
                                                <select class="form-control" name="kota_domisili">
                                                    <option value="3">-Select City-</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label" for="email">Address</label>
                                            <textarea name="" id="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between pt-3">
                                        <button type="button" class="btn btn-light">
                                            X Cancel
                                        </button>
                                        <button type="button" class="btn btn-next ms-2" data-bs-toggle="modal"
                                            data-bs-target="#modal-regular-register">
                                            Lanjutkan
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-regular-register" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body modal-register-body">
                                                        <div class="modal-register-form-group">
                                                            <label class="modal-register-label">
                                                                <span style="color: #ff0000">*</span>
                                                                Kirimkan CV
                                                            </label>
                                                            <input type="file" class="form-control"
                                                                aria-label="file example" required />
                                                        </div>

                                                        <div class="modal-register-form-group">
                                                            <label class="modal-register-label">
                                                                <span style="color: #ff0000">*</span>
                                                                Alasan Anda ingin mengikuti program
                                                                beasiswa Regular Time Bootcamp di Phincon
                                                                Academy?
                                                            </label>

                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>

                                                        <div class="modal-register-form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="" id="flexCheckDefault" />
                                                                <label class="form-check-label" for="flexCheckDefault">
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
                                                        <button type="button" class="btn btn-next">
                                                            Lanjutkan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
