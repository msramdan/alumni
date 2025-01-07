@extends('frontend.landing')

@section('title', __('Form Aduan'))

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Existing styles */
        .card {
            border: none;
            border-radius: 8px;
            transition: transform 0.3s ease;
            background-color: #f9f9f9;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            color: #555;
            font-size: 1rem;
        }

        .pagination-container {
            margin-top: 20px;
        }

        .pagination {
            display: inline-flex;
            justify-content: center;
            padding-left: 0;
            list-style: none;
            border-radius: 0.375rem;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            border-radius: 50%;
            padding: 10px 15px;
            background-color: #fff;
            border: 1px solid #ccc;
            color: #007bff;
        }

        .pagination .active .page-link {
            background-color: #4caf50;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #e0e0e0;
        }

        .badge {
            font-size: 0.875rem;
            font-weight: 500;
            padding: 5px 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .d-flex {
            display: flex;
            align-items: center;
        }

        .me-2 {
            margin-right: 10px;
        }

        .fa-calendar-alt,
        .fa-user {
            margin-right: 5px;
        }

        .card {
            border: none;
            border-radius: 35px;
            transition: transform 0.3s ease;
            background-color: #f9f9f9;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Suggestion list styles */
        #suggestion-list {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ddd;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            z-index: 100;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f1f1f1;
        }
    </style>

    <style>
        .modal-backdrop.show {
            opacity: 1;
        }
    </style>

    @if (!session()->has('sessionPasswordAlumni'))
        <!-- Modal Bootstrap 5 -->
        <div class="modal fade" id="passwordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Akses Halaman</h5>
                    </div>
                    <div class="modal-body">
                        <form id="passwordForm">
                            <div class="mb-3">
                                <label for="password" class="form-label">Masukkan Password:</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div id="error-message" class="text-danger"></div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                        <a href="{{ url('/') }}" class="btn btn-secondary w-100 mt-3">Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <main class="main">
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0"></h1>
            </div>
        </div>

        <section id="starter-section" class="starter-section section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Daftar Alumni</h2>
                <p>Berikut adalah daftar alumni yang telah terdaftar di sistem kami. Temukan alumni yang ingin Anda cari.
                </p>
            </div>
            <div class="container" data-aos="fade-up">
                <!-- Start Search Bar -->
                <div class="row mb-4 position-relative">
                    <div class="col-md-4 ms-auto"> <!-- ms-auto pushes it to the right -->
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" id="search"
                                placeholder="Cari Alumni..." value="" autocomplete="off">
                            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i> Cari</button>
                        </div>
                        <div id="suggestion-list"></div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($alumnis as $alumni)
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('web.detail', ['randomNoReg' => substr(md5($alumni->no_reg), 0, 8)]) }}"
                                class="text-decoration-none">
                                <div class="card">
                                    <img src="{{ $alumni->photo ? asset('uploads/photos/' . $alumni->photo) : 'https://via.placeholder.com/350?text=No+Image+Available' }}"
                                        alt="Photo" class="card-img-top rounded" height="300"
                                        style="object-fit: cover">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $alumni->nama }}</h5>
                                        <p class="card-text">
                                            <i class="fas fa-map-marker-alt"></i> {{ $alumni->tempat_lahir }} <br>
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($alumni->tanggal_lahir)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                <div class="pagination-container text-center mt-4">
                    {{ $alumnis->links('pagination::bootstrap-5') }}
                </div>
                <!-- End List Alumni -->
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // JavaScript/jQuery for search suggestions
        document.getElementById('search').addEventListener('input', function() {
            let query = this.value;
            if (query.length > 2) { // Only start searching after 3 characters
                fetchSuggestions(query);
            } else {
                document.getElementById('suggestion-list').style.display = 'none';
            }
        });

        function fetchSuggestions(query) {
            fetch('{{ route('alumni.search') }}?query=' + query)
                .then(response => response.json())
                .then(data => {
                    let suggestions = data.suggestions;
                    let suggestionList = document.getElementById('suggestion-list');
                    suggestionList.innerHTML = '';

                    suggestions.forEach(suggestion => {
                        let div = document.createElement('div');
                        div.classList.add('suggestion-item');
                        div.textContent = suggestion.nama;
                        div.addEventListener('click', function() {
                            window.location.href = suggestion.url;
                        });
                        suggestionList.appendChild(div);
                    });

                    suggestionList.style.display = suggestions.length > 0 ? 'block' : 'none';
                });
        }
    </script>
    <script>
        $(document).ready(function() {
            @if (!session()->has('sessionPasswordAlumni'))
                // Show the modal when the page loads
                var passwordModal = new bootstrap.Modal($('#passwordModal')[0]);
                passwordModal.show();

                // Handle password form submission
                $('#passwordForm').submit(function(e) {
                    e.preventDefault();

                    var password = $('#password').val();
                    var errorMessage = $('#error-message');

                    $.ajax({
                        url: '{{ route('alumni.checkPassword') }}',
                        method: 'POST',
                        data: JSON.stringify({
                            password: password
                        }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.success) {
                                location.reload(); // Reload page if successful
                            } else {
                                errorMessage.text(data.message);
                            }
                        },
                        error: function() {
                            errorMessage.text('Terjadi kesalahan, coba lagi.');
                        }
                    });
                });
            @endif
        });
    </script>

@endsection
