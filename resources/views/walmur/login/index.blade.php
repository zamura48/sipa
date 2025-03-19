@extends('template.login')

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="{{ route('walmur.do_log') }}" method="POST">
                        @csrf
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Selamat Datang Di Login Wali Murid</p>
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="textt" id="username" name="username" class="form-control form-control-lg"
                                placeholder="Masukkan username" />
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Masukkan password" />
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Belum punya akun? <a href="{{ route('walmur.regis') }}"
                                    class="link-danger">Daftar Sekarang</a></p>
                            <small class="text-danger px-1">Note: Setelah melakukan pendaftaran, tunggu hingga admin melakukan
                                konfirmasi. Kemudian anda akan mendapatkan notif yang berisi username dan password yang
                                digunakan untuk login.</small>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
