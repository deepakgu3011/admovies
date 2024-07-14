@extends('layouts.app')

@section('content')
    <div class="container1 w-50">
        @if (Session('success'))
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Movie or Webseries Added Successfully!",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        <form action="{{ route('movie.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>

            <label for="name">Movie/Series Name</label>
            <input type="text" name="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="director">Director Name</label>
            <input type="text" name="dirname" required>
            @error('dirname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="year">Release Year</label>
            <input type="text" name="rdate" id="">
            @error('rdate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="year">Image</label>
            <input type="file" name="pic" id="">
            @error('pic')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <div id="url-inputs">
                <label for="url" style="width: auto;">Download Link</label>
                <span><button type="button" id="add-url" class="btn btn-success">+</button></span>
                <input type="url" name="urls[]" id="" >
                <label for="size">File Size</label>
                <input type="text" name="size[]" id="" >
            </div>
            @error('url')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="year">Select Category</label>
            @error('category')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <select name="category" id="">
                <option value="movies">Movies</option>
                <option value="webseries">Web Series</option>
            </select>

            <label for="year">Description</label>
            <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
            @error('desc')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <button type="submit" class="btn btn-success">Add Movie/ Series</button>
        </form>
    </div>


@endsection
