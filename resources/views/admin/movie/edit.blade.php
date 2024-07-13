@extends('layouts.app')

@section('content')
    <div class="container1">
        @if (Session::has('success'))
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Movie or Webseries Updated Successfully!",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        <form action="{{ route('movie.update', $movies->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <label for="name">Movie/Series Name</label>
            <input type="text" name="name" value="{{ old('name', $movies->name ?? '') }}" id="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="director">Director Name</label>
            <input type="text" name="dirname" value="{{ old('dirname', $movies->dirname ?? '') }}" required>
            @error('dirname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="year">Release Year</label>
            <input type="text" name="rdate" value="{{ old('rdate', $movies->rdate ?? '') }}">
            @error('rdate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="year">Image <i class="fa fa-eye fa-regular" aria-hidden="true" onclick="show()"></i></label>
            <input type="file" name="pic" id="imageInput" onchange="previewImage(event)">
            <i class="fa-solid fa-xmark" id="removeButton" onclick="removeImage()" style="display: none;"></i>
            <img src="{{ url($movies->pic) }}" alt="" id="image" style="display: none;">
            <br>
            @error('pic')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="year">Download Link</label>
            <input type="url" name="url" value="{{ old('url', $movies->url ?? '') }}">
            @error('url')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="category">Select Category</label>
            @error('category')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <select name="category" id="category">
                <option value="movies" {{ old('category', $movies->category ?? '') == 'movies' ? 'selected' : '' }}>Movies</option>
                <option value="webseries" {{ old('category', $movies->category ?? '') == 'webseries' ? 'selected' : '' }}>Web Series</option>
            </select>
            <br>

            <label for="desc">Description</label>
            <textarea name="desc" id="desc" cols="30" rows="10">{{ old('desc', $movies->desc ?? '') }}</textarea>
            @error('desc')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <label for="status">Status</label><br>
            <div class="d-flex w-25">
                <label for="active">Active</label>
                <input type="radio" name="status" id="active" value="active" {{ old('status', $movies->status ?? '') == 'active' ? 'checked' : '' }} style="width: 2rem;">
            </div>
            <div class="d-flex w-25">
                <label for="inactive">Inactive</label>
                <input type="radio" name="status" id="inactive" value="inactive" {{ old('status', $movies->status ?? '') == 'inactive' ? 'checked' : '' }} style="width: 2rem;">
            </div>

            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            <button type="submit" class="btn btn-success">Add Movie/ Series</button>
        </form>
    </div>
    <script>
        function show() {
            var imgElement = document.getElementById("image");
            var name = document.getElementById("name").value;
            var cate = document.getElementById("category").value;
            var pic = imgElement.src;
            Swal.fire({
                title: cate,
                text: name,
                imageUrl: pic,
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image"
            });
        }

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
