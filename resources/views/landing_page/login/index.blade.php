@extends('template.landing')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="card text-center">
                            <div class="card-header border-bottom-0 bg-transparent">
                                <h4>Login Sebagai Wali Murid</h4>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('walmur.login') }}" class="btn btn-primary">Login Wali Murid</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card text-center">
                            <div class="card-header border-bottom-0 bg-transparent">
                                <h4>Login Sebagai Pengurus</h4>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('pengurus.login') }}" class="btn btn-primary">Login Pengurus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

    </main>
@endsection

@push('js')
@endpush
