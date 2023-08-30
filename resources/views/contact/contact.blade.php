@extends('layouts.homepage')

@section('content')
<div class="container">
    <h1>Contact Us</h1>
    <p>Welcome to our Contact Us page!</p>
    <p>If you have any questions or inquiries, feel free to reach out to us using the contact information below:</p>
    <ul>
        <li>Email: contact@example.com</li>
        <li>Phone: +1 123-456-7890</li>
        <li>Address: 123 Main Street, City, Country</li>
    </ul>

    <h2>Send Us a Message</h2>
    <form method="POST" action="{{ route('contact.send') }}">
        @csrf

        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="message">Your Message</label>
            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>
@endsection
