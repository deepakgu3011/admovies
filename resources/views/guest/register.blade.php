@extends('layouts.app')
@push('title')
    <title>Login</title>
@endpush
@section('content')
@if (Session('success'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Thanks for Registered With US.",
        showConfirmButton: false,
        timer: 1500
    });
</script>

@endif
    <div class="container1">
        <h1>Admin login </h1>
        <div class="col">
            <div class="row-6">
                <form action="{{ url('register') }}" method="post">
                    @csrf
                    <label for="name">User Name</label><br>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="name">Email</label><br>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password" required><br>
                    <label for="password">Confirm Password</label><br>
                    <input type="password" name="cpassword" id="cpassword" required><br>
                    <button type="submit"> Register </button>
                </form>
                <p>You have Already Account <a href="{{ url('login') }}"><button>login</button></a></p>
            </div>
        </div>
    </div>
@endsection
