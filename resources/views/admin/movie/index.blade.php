{{-- admin.movie.index.blade.php --}}

@if ($movies->isEmpty())
    <p>No movies or web series found.</p>
@else
    <ul>
        @foreach ($movies as $movie)
            <li>{{ $movie->name }} - {{ $movie->dirname }}</li>
            <!-- Adjust the fields based on your Movie model structure -->
        @endforeach
    </ul>
@endif
