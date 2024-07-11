@extends('layouts.app')
@section('content')
<div class="container2">
    <div class="back">
        <a href="{{ url('/') }}">Home</a>&nbsp;&nbsp;/&nbsp;&nbsp;
        <a href="{{ url('/about') }}"  class="disabled-link">About us</a>
    </div>
    <header>
        <h1>Welcome to <span>Filmi Duniya</span></h1>
        <p>Your ultimate destination for all things cinema.</p>
    </header>

    <section class="mission">
        <h2>Our Mission</h2>
        <p>At <span>Your Movie Website</span>, our mission is to provide you with comprehensive and insightful coverage of the world of movies. We strive to deliver:</p>
        <ul>
            <li><strong>Latest Updates:</strong> Stay informed with the latest news, trailers, and releases from Hollywood and beyond.</li>
            <li><strong>In-Depth Reviews:</strong> Dive deep into our expert reviews and analysis of both current hits and timeless classics.</li>
            <li><strong>Behind-the-Scenes:</strong> Explore the fascinating world behind the camera with exclusive interviews, director spotlights, and industry insights.</li>
        </ul>
    </section>

    <section class="why-choose-us">
        <h2>Why Choose Us?</h2>
        <ul>
            <li><strong>Passion for Film:</strong> We are driven by our love for cinema and aim to share that passion with our audience.</li>
            <li><strong>Reliable Information:</strong> Count on us for accurate and up-to-date information about movies and the entertainment industry.</li>
            <li><strong>Community Engagement:</strong> Join our vibrant community of movie enthusiasts, where you can discuss, debate, and share your thoughts on your favorite films.</li>
        </ul>
    </section>

    <section class="contact-us">
        <h2>Contact Us</h2>
        <p>Have questions or suggestions? We'd love to hear from you!</p>
        <ul>
          <li>Email: <a href="mailto:your-email&#64;example.com">abc&#64;gmail.com</a></li>
          <li>Address: PUNJAB </li>
        </ul>
    </section>

    <section class="follow-us">
        <h2>Follow Us</h2>
        <p>Stay connected with us on social media:</p>
        <ul class="social-links">
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
        </ul>
    </section>
  </div>

@endsection
