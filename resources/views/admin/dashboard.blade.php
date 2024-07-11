@extends('layouts.app')
@push('title')
<title>Admin </title>
@endpush
@section('content')
<h1>Hello {{ auth()->user()->name }}</h1>

<div class="container2">
    <a href="{{ route('movie.create') }}" class="btn btn-success">Add New Movies Or Webseries</a>
    <div id="movies-container" style="margin-top:2rem; ">
    </div>
</div>

<script>
  $(document).ready(function() {
    $.ajax({
        url: '{{ route("movie.index") }}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            var moviesList = '<div class="card-deck">';
            $.each(response, function(index, movie) {
                moviesList += '<div class="card" style="margin-top: 2rem;">';
                moviesList += '<img src="' + movie.pic + '" class="card-img-top" alt="Movie Image" style="height:200px;object-fit: cover;">';
                moviesList += '<div class="card-body">';
                moviesList += '<h5 class="card-title"><a href="/movie/' + movie.id + '">' + movie.name + '</a></h5>'; // Adjusted URL construction
                moviesList += '<p class="card-text"><b>Director:</b> ' + movie.dirname + '</p>';
                moviesList += '<p class="card-text"><strong>Release Date:</strong> ' + movie.rdate + '</p>';
                moviesList += '<p class="card-text">' + movie.desc + '</p>';
                moviesList += '<a href="' + movie.url + '" class="btn btn-success">Download</a>';
                moviesList += '</div>'; // Close card-body
                moviesList += '</div>'; // Close card
            });
            moviesList += '</div>'; // Close card-deck

            $('#movies-container').html(moviesList); // Use html() to replace content instead of append()

            // Optional: Initialize any JavaScript plugins or adjust DOM elements after rendering movies
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error fetching movies.');
        }
    });
});

</script>
@endsection
