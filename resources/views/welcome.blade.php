<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top"
        style="background: linear-gradient(to right, #4b006e, #ff6e7f); margin-top: -1px;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Daily Quotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="" class="text-white dropdown-item dropdown-hover">Romance</a></li>
                            <li><a href="" class="dropdown-item text-white dropdown-hover">Motivasi</a></li>
                            <li><a href="" class="dropdown-item text-white dropdown-hover">Kebijaksanaan</a></li>
                            <li><a href="" class="dropdown-item text-white dropdown-hover">Humor</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="" class="nav-link btn-generate" data-bs-toggle="modal"
                            data-bs-target="#generateQuotesModal">Generate Quotes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif

    @if (session('alert'))
        <script>
            alert('{{ session('alert') }}');
        </script>
    @endif

    <div class="container-fluid my-5" style="padding-top: 50px;">
        <div class="row justify-content-center">
            @foreach ($data as $row)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card text-white">
                        {{-- <div class="down"> --}}
                        <img src="{{ url($row['image']) }}" alt="" class="card-img"
                            style="height: 200px; object-fit: cover;">
                        <div
                            class="card-img-overlay d-flex flex-column justify-content-center bg-dark bg-opacity-50 p-3 rounded">
                            <p class="card-text text-center fw-bold">"{{ $row['text'] }}"</p>
                            <small class="card-text text-center">- {{ $row['author'] }}</small>
                        </div>
                        {{-- </div> --}}
                        <button onclick="downloadCard(this)"
                            class="btn btn-light btn-sm position-absolute end-0 bottom-0 m-2 no-capture">
                            <i class="bi bi-download"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tombol buka modal -->
    {{-- <button type="button" class="btn btn-light text-dark" data-bs-toggle="modal" data-bs-target="#generateQuotesModal">
        Generate Quotes
    </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="generateQuotesModal" tabindex="-1" aria-labelledby="generateQuotesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header"
                    style="background: linear-gradient(to right, #4b006e, #ff6e7f); color: white;">
                    <h5 class="modal-title" id="generateQuotesLabel">Generate Quotes</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('generate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="text" class="form-label">Quotes Of The Day</label>
                            <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author (opsional)</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Background</label>
                            <input class="form-control" type="file" id="image" name="image"
                                accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadCard(button) {
            let card = button.closest('.card');

            // Sembunyiin tombol download dulu biar gak ikut ke-capture
            let downloadButton = card.querySelector('.no-capture');
            downloadButton.style.display = 'none';

            html2canvas(card).then(canvas => {
                let link = document.createElement('a');
                link.download = 'quote.png';
                link.href = canvas.toDataURL();
                link.click();

                // Balikin tombol download
                downloadButton.style.display = 'block';
            });
        }
    </script>
</body>

</html>
