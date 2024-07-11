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
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    <div class="container1">
        <h1>Admin login </h1>
        <div class="col">
            <div class="row-6">
                <form action="{{ url('login') }}" method="post" style="padding: 2rem;margin-top: 2rem;">
                    @csrf
                    <label for="name">User Name</label><br>
                    <input type="text" name="name" id="name" required>
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password" required><br>
                    <button type="submit">Login </button>
                </form>
            </div>
        </div>
    </div>
@endsection
