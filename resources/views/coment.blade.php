<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comment</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>
  <body>
    <div style="display: flex; align-items: center; margin-bottom: 20px; margin-top: 30px;">
        <i class="fa-solid fa-arrow-left" style="margin-right: 15px; cursor: pointer; font-size: 20px; margin-left: 30px;" onclick="window.location.href='{{ route('welcome') }}'"></i>
        <span style="font-size: 32px; font-weight: 600; color:#000000;">Semua Komentar</span>
    </div>

    <div class="row">
        @foreach ($ratings as $rating)
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="user-info">
                        <img src="{{ asset('assets/img/team-2.jpg') }}" alt="User Photo" class="user-photo">
                        <div>
                            <h5 class="card-title">{{ $rating->user->name }}</h5>
                            <div class="rating-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                                {{ $rating->rating }}/5
                            </div>
                        </div>
                    </div>
                    <p class="card-text">{{ $rating->ulasan }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($ratings->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo; Sebelumnya</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $ratings->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Sebelumnya</span>
                    </a>
                </li>
            @endif

            @for ($i = 1; $i <= $ratings->lastPage(); $i++)
                <li class="page-item {{ $ratings->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $ratings->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($ratings->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $ratings->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">Selanjutnya &raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Selanjutnya &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
  </body>
</html>
