@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Welcome to Our Film Website!</h1>

        <h2 class="text-center">
            <marquee behavior="alternate" direction="right">Latest Movies And webseries Available:</marquee>
        </h2>
        <hr>

        <h3 class="text-danger">Webseries</h3>
        <div class="row">
            @foreach ($movies as $movie)
                @if ($movie->category === 'webseries')
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="{{ asset($movie->pic) }}" class="card-img-top" alt="{{ $movie->name }}"
                                style="    height: 200px;object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->name }}</h5>
                                <p class="card-text">Director: {{ $movie->dirname }}</p>
                                <p class="card-text">Release Year: {{ $movie->rdate }}</p>
                                <p class="card-text">{{ $movie->desc }}</p>
                                @if (auth()->check())
                                <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-info">More
                                    Information</a>
                            @else
                                <a href="{{ route('user.info',['id' => $movie->id]) }}" class="btn btn-info">More
                                    Information</a>
                            @endif

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <hr>

        <h3 class="text-danger">Movies</h3>
        <div class="row">
            @foreach ($movies as $movie)
                @if ($movie->category === 'movies')
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="{{ url($movie->pic) }}" class="card-img-top" alt="{{ $movie->name }}"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->name }}</h5>
                                <p class="card-text">Director: {{ $movie->dirname }}</p>
                                <p class="card-text">Release Date: {{ $movie->rdate }}</p>
                                <p class="card-text">{{ $movie->desc }}</p>
                                @if (auth()->check())
                                    <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-info">More
                                        Information</a>
                                @else
                                    <a href="{{ route('user.info',['id' => $movie->id]) }}" class="btn btn-info">More
                                        Information</a>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
@endsection
