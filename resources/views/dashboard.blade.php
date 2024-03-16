@extends('layouts.user')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="mt-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}!</h2>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-container">
        <!-- Quick Links Card -->
        <div class="card bg-blue-200 overflow-hidden shadow-xl sm:rounded-lg hover:shadow-2xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
                <ul class="list-inside">
                    <li><a href="home" class="text-blue-500 hover:text-blue-700">Book a Ticket</a></li>
                    <li><a href="booking/history" class="text-blue-500 hover:text-blue-700">View Booking History</a></li>
                    <li><a href="user/profile" class="text-blue-500 hover:text-blue-700">Update Profile</a></li>
                    <!-- Add more quick links based on your application -->
                </ul>
            </div>
        </div>

        <!-- Calendar Card -->
        <div class="card bg-green-200 overflow-hidden shadow-xl sm:rounded-lg hover:shadow-2xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-3">Calendar</h3>
                <!-- Calendar Container -->
                <div id="calendar"></div>
            </div>
        </div>

        <!-- Sacco Promotion Card -->
        <div class="card bg-yellow-200 overflow-hidden shadow-xl sm:rounded-lg hover:shadow-2xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-3">Sacco Promotion</h3>
                <p class="mb-3">Check out our latest promotions!</p>
                <a href="#" class="text-blue-500 hover:text-blue-700">Find out more</a>
            </div>
        </div>

        <!-- Feedback Card -->
        <div class="card bg-pink-200 overflow-hidden shadow-xl sm:rounded-lg hover:shadow-2xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-3">Feedback</h3>
                <p class="mb-3">Let us know about your experience!</p>
                <a href="#" class="text-blue-500 hover:text-blue-700" id="feedbackLink">Give Feedback</a>
            </div>
        </div>
    </div>

    <!-- Feedback Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="feedbackModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-3">Give Feedback</h3>
                <form id="feedbackForm">
                    <div class="mb-4">
                        <label for="feedback" class="block text-sm font-medium text-gray-700">Your Feedback:</label>
                        <textarea id="feedback" name="feedback" rows="4" class="form-textarea mt-1 block w-full"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-800 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @parent
    <style>
        /* Additional custom styles */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.1);
        }

        /* Modal Styles */
        .modal-overlay {
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            position: relative;
            text-align: center;
        }

        .modal-close {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <!-- Include FullCalendar.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/core/main.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/daygrid/main.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/core/main.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/daygrid/main.min.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid' ],
                events: [
                    {
                        title: 'Event 1',
                        start: '2024-08-01'
                    },
                    {
                        title: 'Event 2',
                        start: '2024-08-05'
                    }
                    // Add more events as needed
                ]
            });

            calendar.render();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const feedbackLink = document.getElementById('feedbackLink');
            const feedbackModal = document.getElementById('feedbackModal');
            const modalOverlay = document.createElement('div');
            modalOverlay.classList.add('modal-overlay');

            feedbackLink.addEventListener('click', function(event) {
                event.preventDefault();
                console.log('Feedback Link Clicked');
                feedbackModal.classList.remove('hidden');
                document.body.appendChild(modalOverlay);

                // Focus on the textarea when modal opens
                const feedbackTextarea = feedbackModal.querySelector('textarea[name="feedback"]');
                feedbackTextarea.focus();
            });

            modalOverlay.addEventListener('click', function() {
                console.log('Modal Overlay Clicked');
                feedbackModal.classList.add('hidden');
                document.body.removeChild(modalOverlay);
            });

            // Prevent modal from closing when clicking inside the modal content
            feedbackModal.addEventListener('click', function(event) {
                event.stopPropagation();
            });

            const feedbackForm = document.getElementById('feedbackForm');

            feedbackForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(feedbackForm);
                const feedbackValue = formData.get('feedback');
                console.log('Feedback Submitted:', feedbackValue);
                // You can add AJAX here to submit the form data

                // To keep the modal open after submission, we'll just clear the input
                feedbackTextarea.value = '';
            });
        });
    </script>
@endsection
