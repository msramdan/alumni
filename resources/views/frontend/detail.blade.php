@extends('frontend.landing')

@section('title', __('Detail Alumni'))

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .alumni-photo {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        }

        .alumni-detail {
            padding-left: 30px;
        }

        .alumni-detail h3 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .alumni-detail p {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
        }

        /* Styling for the comment section */
        .comments-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comment-item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comment-item .d-flex {
            align-items: center;
        }

        .comment-item img {
            border-radius: 50%;
        }

        .comment-item p {
            margin: 0;
        }

        .comment-item .text-muted {
            font-size: 0.875rem;
        }

        .comment-item strong {
            font-size: 1rem;
            font-weight: 600;
        }
    </style>

    <main class="main">
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0"></h1>
            </div>
        </div>

        <section id="starter-section" class="starter-section section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Detail Alumni</h2>
            </div>
            <div class="container d-flex justify-content-center" data-aos="fade-up">
                <div class="row">
                    <!-- Left Column: Photo -->
                    <div class="col-md-4 mb-4">
                        <img src="{{ $alumni->photo ? asset('uploads/photos/' . $alumni->photo) : 'https://via.placeholder.com/350?text=No+Image+Available' }}"
                             alt="Photo" class="alumni-photo" />
                    </div>

                    <!-- Right Column: Detail Information -->
                    <div class="col-md-8 mb-4 alumni-detail">
                        <h3>{{ $alumni->nama }}</h3>
                        <p><strong>Tempat Lahir:</strong> {{ $alumni->tempat_lahir }}</p>
                        <p><strong>Tanggal Lahir:</strong>
                            {{ $alumni->tanggal_lahir ? \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d/m/Y') : '-' }}
                        </p>
                        <p>
                            Adalah benar, sah dan tercatat dalam database kami sebagai peserta Diklat, serta diterbitkan Sertifikat {{ $alumni->judul_diklat }}
                            Angkatan {{ $alumni->angkatan }} tanggal {{ $alumni->tanggal_mulai }} s/d {{ $alumni->tanggal_selesai }} yang dilaksanakan di kota {{ $alumni->kota }} Provinsi {{ $alumni->provinsi }}.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
