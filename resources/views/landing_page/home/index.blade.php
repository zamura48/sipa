@extends('template.landing')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="company-badge mb-4">
                                <i class="bi bi-gear-fill me-2"></i>
                                Mewujudkan Kesuksesan Anak Anda
                            </div>

                            <h1 class="mb-4">
                                Asrama SMAN 3 <br>
                                Tempat Untuk Berkembang <br>
                                <span class="accent-text">Sukses Bersama</span>
                            </h1>

                            <p class="mb-4 mb-md-5">
                                Daftarkan anak Anda untuk bergabung di asrama yang aman, nyaman, dan mendukung perkembangan
                                akademik serta kegiatan ekstrakurikuler.
                                Orang tua dapat memantau aktivitas anak melalui platform ini untuk memastikan mereka selalu
                                berada pada jalur yang tepat.
                            </p>

                            <div class="hero-buttons">
                                <a href="{{ route('walmur.login') }}" class="btn btn-primary me-0 me-sm-2 mx-1">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                            <img src="<?= asset('assets/lib/ilanding') ?>/assets/img/illustration-1.webp" alt="Hero Image"
                                class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-house-door"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Ratusan Penghuni</h4>
                                <p class="mb-0">Penghuni dari SMAN 3 dengan pengalaman yang luar biasa</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Aktivitas Terpantau</h4>
                                <p class="mb-0">Orang tua dapat memantau aktivitas anak setiap saat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Kegiatan Terjadwal</h4>
                                <p class="mb-0">Setiap penghuni memiliki jadwal kegiatan yang terorganisir</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Keamanan Terjamin</h4>
                                <p class="mb-0">Fasilitas asrama dilengkapi dengan pengawasan dan sistem keamanan yang
                                    ketat</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Hero Section -->


        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center justify-content-between">

                    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <span class="about-meta">TENTANG KAMI</span>
                        <h2 class="about-title">Fasilitas Asrama yang Mendidik dan Mengembangkan</h2>
                        <p class="about-description">
                            Kami menyediakan fasilitas asrama yang aman dan mendukung perkembangan siswa SMAN 3. Dengan
                            sistem pengawasan yang transparan, orang tua dapat selalu memantau aktivitas anak-anak mereka,
                            baik dalam kegiatan akademik maupun ekstrakurikuler. Kami berkomitmen untuk menciptakan
                            lingkungan yang mendidik dan mempersiapkan siswa untuk masa depan yang sukses.
                        </p>

                        <div class="row feature-list-wrapper">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Lingkungan yang Aman dan Nyaman</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Kegiatan Akademik Terpadu</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Pengawasan 24/7 untuk Orang Tua</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Kegiatan Ekstrakurikuler Berkualitas</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Fasilitas Lengkap dan Modern</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Program Pembinaan Karakter</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-wrapper">
                            <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                                <img src="<?= asset('assets/lib/ilanding') ?>/assets/img/about-5.webp" alt="Asrama Image"
                                    class="img-fluid main-image rounded-4">
                                <img src="<?= asset('assets/lib/ilanding') ?>/assets/img/about-2.webp"
                                    alt="Kegiatan Siswa" class="img-fluid small-image rounded-4">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->


        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Fitur Kami</h2>
                <p>Fasilitas yang kami tawarkan untuk mendukung perkembangan siswa dan memberikan kemudahan bagi orang tua
                    dalam memantau aktivitas anak-anak mereka.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="d-flex justify-content-center">

                    <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                <h4>Pengawasan Orang Tua</h4>
                            </a>
                        </li><!-- End tab nav item -->

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                <h4>Kegiatan Akademik</h4>
                            </a><!-- End tab nav item -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                <h4>Kegiatan Ekstrakurikuler</h4>
                            </a>
                        </li><!-- End tab nav item -->

                    </ul>

                </div>

                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                    <div class="tab-pane fade active show" id="features-tab-1">
                        <div class="row">
                            <div
                                class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                <h3>Pengawasan 24/7 oleh Orang Tua</h3>
                                <p class="fst-italic">
                                    Orang tua dapat memantau aktivitas anak setiap saat, baik dalam kegiatan akademik maupun
                                    kegiatan harian lainnya di asrama.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Melihat absensi dan kegiatan harian siswa
                                            secara real-time.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Memperoleh laporan aktivitas anak setiap
                                            minggu.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Notifikasi instan jika ada perubahan penting
                                            terkait siswa.</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="<?= asset('assets/lib/ilanding') ?>/assets/img/features-illustration-1.webp"
                                    alt="Pengawasan Orang Tua" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End tab content item -->

                    <div class="tab-pane fade" id="features-tab-2">
                        <div class="row">
                            <div
                                class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                <h3>Kegiatan Akademik yang Terintegrasi</h3>
                                <p class="fst-italic">
                                    Kami menawarkan program akademik yang terstruktur, dengan jadwal yang dapat diakses oleh
                                    orang tua untuk memantau perkembangan anak.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Jadwal pelajaran dan tugas yang dapat
                                            diakses oleh orang tua.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Laporan akademik berkala mengenai kemajuan
                                            siswa.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Pembelajaran dengan metode yang mendukung
                                            karakter dan kecakapan hidup.</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="<?= asset('assets/lib/ilanding') ?>/assets/img/features-illustration-2.webp"
                                    alt="Kegiatan Akademik" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End tab content item -->

                    <div class="tab-pane fade" id="features-tab-3">
                        <div class="row">
                            <div
                                class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                <h3>Kegiatan Ekstrakurikuler Berkualitas</h3>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Beragam kegiatan untuk mengembangkan minat
                                            dan bakat siswa.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Kegiatan yang melibatkan orang tua dalam
                                            proses evaluasi.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Fasilitas olahraga dan seni yang mendukung
                                            perkembangan fisik dan mental siswa.</span></li>
                                </ul>
                                <p class="fst-italic">
                                    Selain akademik, kami juga menyediakan berbagai kegiatan ekstrakurikuler untuk membentuk
                                    karakter dan keterampilan sosial siswa.
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="<?= asset('assets/lib/ilanding') ?>/assets/img/features-illustration-3.webp"
                                    alt="Kegiatan Ekstrakurikuler" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End tab content item -->

                </div>

            </div>

        </section><!-- /Features Section -->


        <!-- Features Cards Section -->
        <section id="features-cards" class="features-cards section">
            <div class="container">
                <div class="row gy-4">
                    <!-- Pendaftaran -->
                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="feature-box orange">
                            <i class="bi bi-person-plus"></i>
                            <h4>Pendaftaran Asrama</h4>
                            <p>Orang tua dapat mendaftarkan anak mereka untuk menempati asrama SMAN 3 melalui sistem online
                                dengan mudah.</p>
                        </div>
                    </div><!-- End Feature Box -->

                    <!-- Kegiatan Harian -->
                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="feature-box blue">
                            <i class="bi bi-calendar-check"></i>
                            <h4>Kegiatan Harian</h4>
                            <p>Penghuni asrama mengikuti kegiatan yang terjadwal seperti belajar kelompok, olahraga, dan
                                diskusi keagamaan.</p>
                        </div>
                    </div><!-- End Feature Box -->

                    <!-- Absensi -->
                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="feature-box green">
                            <i class="bi bi-clipboard-check"></i>
                            <h4>Absensi Aktivitas</h4>
                            <p>Absensi digital memantau kehadiran penghuni dalam setiap aktivitas untuk memastikan
                                keterlibatan mereka.</p>
                        </div>
                    </div><!-- End Feature Box -->

                    <!-- Monitoring Orang Tua -->
                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="feature-box red">
                            <i class="bi bi-eye"></i>
                            <h4>Monitoring Orang Tua</h4>
                            <p>Orang tua dapat memantau aktivitas dan perkembangan anak mereka melalui dashboard online.</p>
                        </div>
                    </div><!-- End Feature Box -->
                </div>
            </div>
        </section>
        <!-- /Features Cards Section -->

        <!-- Features 2 Section -->
        <section id="features-2" class="features-2 section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center d-flex justify-content-center">
                    <div class="col-lg-4">
                        <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="200">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="feature-content">
                                    <h3>Pendaftaran Mudah</h3>
                                    <p>Pendaftaran dapat dilakukan kapan saja melalui sistem online, memastikan kemudahan
                                        bagi orang tua.</p>
                                </div>
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="300">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="feature-content">
                                    <h3>Dashboard Penghuni</h3>
                                    <p>Penghuni dapat melihat jadwal aktivitas, tugas, dan pengumuman penting melalui
                                        dashboard mereka.</p>
                                </div>
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-display"></i>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item text-end" data-aos="fade-right" data-aos-delay="400">
                            <div class="d-flex align-items-center justify-content-end gap-4 d-none">
                                <div class="feature-content">
                                    <h3>Notifikasi Real-Time</h3>
                                    <p>Orang tua menerima notifikasi langsung tentang absensi, aktivitas, dan perkembangan
                                        anak mereka.</p>
                                </div>
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-bell"></i>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->
                    </div>

                    <div class="col-lg-4">
                        <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="200">
                            <div class="d-flex align-items-center gap-4">
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-calendar4-week"></i>
                                </div>
                                <div class="feature-content">
                                    <h3>Jadwal Terstruktur</h3>
                                    <p>Setiap kegiatan di asrama diatur dalam jadwal yang terstruktur untuk mendukung
                                        kedisiplinan penghuni.</p>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="300">
                            <div class="d-flex align-items-center gap-4">
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-cloud-arrow-down"></i>
                                </div>
                                <div class="feature-content">
                                    <h3>Dokumentasi Aktivitas</h3>
                                    <p>Setiap aktivitas didokumentasikan dan dapat diakses oleh orang tua melalui sistem.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->

                        <div class="feature-item" data-aos="fade-left" data-aos-delay="400">
                            <div class="d-flex align-items-center gap-4 d-none">
                                <div class="feature-icon flex-shrink-0">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <div class="feature-content">
                                    <h3>Statistik Perkembangan</h3>
                                    <p>Statistik tentang kehadiran, aktivitas, dan pencapaian ditampilkan dalam grafik yang
                                        mudah dipahami.</p>
                                </div>
                            </div>
                        </div><!-- End .feature-item -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /Features 2 Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Penghuni</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Pengurus</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-4 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Admin</p>
                        </div>
                    </div><!-- End Stats Item -->
                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section light-background d-none">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5">
                        <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                            <h3>Info Kontak</h3>
                            <p>Punya pertanyaan atau ingin tahu lebih banyak tentang layanan kami? Tim kami siap membantu Anda!</p>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="content">
                                    <h4>Our Location</h4>
                                    <p>Jl. Raya Kandung Dsn. Purwodadi Kidul, RT.02/RW.08, Purwodadi, Tanen, Kec. Rejotangan, Kabupaten Tulungagung</p>
                                    <p>Jawa Timur 66293</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="content">
                                    <h4>Phone Number</h4>
                                    <p>0821-4100-4788</p>
                                </div>
                            </div>

                            <div class="info-item d-none" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4>Email Address</h4>
                                    <p>info@example.com</p>
                                    <p>contact@example.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                            <h3>Get In Touch</h3>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante
                                ipsum primis.</p>

                            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                                data-aos-delay="200">
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Your Email" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject"
                                            required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>

                                        <button type="submit" class="btn">Send Message</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>
@endsection

@push('js')
@endpush
