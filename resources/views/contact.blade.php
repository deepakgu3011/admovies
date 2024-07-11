@extends('layouts.app')
@section('content')
@if (session('success'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Thanks for contacting us. We will get back to you as soon as possible.",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@elseif (session('fail'))
<script>
    Swal.fire({
        position: "top-end",
        icon: "error",
        title: "Oops...",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif
    <div class="container1">
        <div class="back">
            <a href="{{ url('/') }}">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a href="{{ url('/contacts') }}"  class="disabled-link">Contact </a>
        </div>
        <header>
            <h1>Contact Us</h1>
            <p>Have questions or suggestions? We'd love to hear from you!</p>
        </header>

        <section class="contact-details">
            <h2>Contact Details</h2>
            <ul>
                <li><strong>Email:</strong> <a href="mailto:abc&#64;gmail.com">abc&#64;gmail.com</a></li>
                <li><strong>Phone:</strong> +91 00000-11111</li>
                <li><strong>Address:</strong> 123 Movie Street, Bollywood, Mumbai, 90001</li>
            </ul>
        </section>

        <section class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" Name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" Name="email"value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" Name="message" rows="5" value="{{ old('message') }}" required></textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit">Send Message</button>
            </form>
        </section>
    </div>
@endsection
