@extends('frontend.landing')

@section('title', __('Home'))

@section('content')
    <main class="main">
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="{{ asset('landing') }}/assets/img/hero-bg-light.webp" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Welcome to <span>Alumni Validation</span></h1>
                    <p data-aos="fade-up" data-aos-delay="100">
                        Platform ini dibuat untuk memvalidasi apakah alumni terdaftar atau tidak dengan cepat dan efisien.
                    </p>

                    </p>
                    <img src="{{ asset('landing') }}/assets/img/hero-services-img.webp" class="img-fluid hero-img"
                        alt="" data-aos="zoom-out" data-aos-delay="300">
                </div>
            </div>
        </section>

        <section id="featured-services" class="featured-services section light-background">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-person-check"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Validasi Alumni</a></h4>
                                <p class="description">Cek status alumni apakah terdaftar di database kami dengan mudah dan cepat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-file-earmark-check"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Proses Verifikasi</a></h4>
                                <p class="description">Proses verifikasi yang cepat dan aman untuk memastikan status alumni terdaftar.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-shield-check"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Akses Aman</a></h4>
                                <p class="description">Kami menjaga data alumni dengan sistem keamanan terbaik untuk memastikan kevalidan informasi.</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </section>

    </main>
@endsection
