@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @if ($movie->pic)
            <img src="{{ asset($movie->pic) }}" alt="{{ $movie->name }}" style="max-width: 100%; height: auto;">
            @endif
        </div>
        <div class="col-md-8">
            <h1>{{ $movie->name }}</h1>
            <p><strong>Director:</strong> {{ $movie->dirname }}</p>
            <p><strong>Release Date:</strong> {{ $movie->rdate }}</p>
            <p><strong>Description:</strong> {{ $movie->desc }}</p>
            <p><strong>Category:</strong> {{ ucfirst($movie->category) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($movie->status) }}</p>
            <p><strong>Download Link:</strong> <a href="{{ $movie->url }}"><i class="fa fa-download" aria-hidden="true"></i></a></p>
            <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-info">Edit</a>
        </div>
    </div>
</div>
@endsection
