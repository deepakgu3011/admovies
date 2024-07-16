@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="back">
            <a href="{{ url('/dashboard') }}">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a href="{{ url('/') }}" class="disabled-link">{{ $movie->name }}</a>
        </div>
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
                @php
                    use Carbon\Carbon;
                    $istTime = Carbon::parse($movie->updated_at)
                        ->setTimezone('Asia/Kolkata')
                        ->format('d-M-y h:i A');
                @endphp
                <p><strong>Last Update:</strong> {{ $istTime }}</p>
                @if ($movie->movieurl->isEmpty())
                    <p><strong>Download Link:</strong> <a href="{{ $movie->url }}"><i class="fa fa-download"
                                aria-hidden="true"></i></a></p>
                @else
                    @foreach ($movie->movieurl as $url)
                        <p><strong>Download Link:</strong> <a href="{{ $url->url }}" class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"> <b>File Size
                                        &nbsp;</b>{{ $url->file_size }}</i></a></p>
                    @endforeach
                @endif
                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-info m-3">Edit</a>
            </div>
        </div>
    </div>
@endsection
