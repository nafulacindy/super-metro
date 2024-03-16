@extends('layouts.homepage')

@section('content')
<style>
    h1 {
        font-size: 50px;
        margin-top: 20px;
        color: white;
        text-align: center;
        border-bottom: 2px solid white;
        padding-bottom: 10px;
    }

    p {
        margin: 20px auto;
        font-weight: 100;
        line-height: 25px;
        color: white;
        text-align: center;
    }

    .card {
        background-color: white;
        border: 1px solid rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card-body {
        height: 100%;
    }

    .contact-info h2 {
        color: #009688;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .contact-info ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-info li {
        margin-bottom: 30px;
        font-size: 16px;
        line-height: 2.0; 
    }

</style>

<div class="container">
    <h1>Contact Us</h1>
    <p>Welcome to our Contact Us page!</p>

    <div class="row">
        <!-- Contact Information Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body contact-info">
                    <h2>Contact Information</h2>
                    <ul>
                        <li><strong>Email:</strong> contact@example.com</li>
                        <li><strong>Phone:</strong> +1 123-456-7890</li>
                        <li><strong>Address:</strong> 123 Main Street, City, Country</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Send Message Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
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
            </div>
        </div>
    </div>
</div>
@endsection
