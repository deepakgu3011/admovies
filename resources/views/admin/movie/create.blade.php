@extends('layouts.app')

@section('content')
    <div class="container1">
        <div class="back">
            <a href="{{ url('/dashboard') }}">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a href="{{ url('/') }}"  class="disabled-link">{{ "Create New Movies" }}</a>
        </div>
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

            <label for="image">Image</label>
            <input type="file" name="pic" id="imageInput" onchange="previewImage(event)">
            @error('pic')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            <i class="fa-solid fa-xmark" id="removeButton" onclick="removeImage()" style="display: none;"></i>

            <img id="image" style="display: none; max-width: 100px; max-height: 100px;">
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

<script>
function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image');
                var removeButton = document.getElementById('removeButton');
                output.src = reader.result;
                output.style.display = 'block';
                removeButton.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function removeImage() {
            var imageInput = document.getElementById('imageInput');
            var image = document.getElementById('image');
            var removeButton = document.getElementById('removeButton');
            imageInput.value = '';
            image.src = '';
            image.style.display = 'none';
            removeButton.style.display = 'none';
        }
</script>
@endsection
