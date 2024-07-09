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

        <!-- Report Lost Items Card -->
        <div class="card bg-yellow-200 overflow-hidden shadow-xl sm:rounded-lg hover:shadow-2xl">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-3">Report Lost Items</h3>
                <p class="mb-3">Have you lost something during your travel?</p>
                <a href="#" class="text-blue-500 hover:text-blue-700" id="reportLostItemsLink">Report Now</a>
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

   <!-- Report Lost Items Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="reportLostItemsModal">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h3 class="text-lg font-semibold mb-3">Report Lost Items</h3>
            <form action="{{ route('submitLostItemReport') }}" method="post" id="reportLostItemsForm">

                @csrf
                <div class="mb-4">
                    <label for="busRegistration" class="block text-sm font-medium text-gray-700">Bus Registration Number:</label>
                    <input type="text" id="busRegistration" name="bus_registration" class="form-input mt-1 block w-full" placeholder="Enter Bus Registration Number">
                    <label for="travelDate" class="block text-sm font-medium text-gray-700">Date of Travel:</label>
                    <input type="text" id="travelDate" name="travelDate" class="form-input mt-1 block w-full" placeholder="Enter Date of Travel">
                    <label for="luggageDescription" class="block text-sm font-medium text-gray-700">Luggage Description:</label>
                    <input type="text" id="luggageDescription" name="luggageDescription" class="form-input mt-1 block w-full" placeholder="LuggageDescription">
                </div>
                <!-- Other input fields for lost item report -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-800 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Submit</button>
                    <button type="button" class="bg-gray-400 text-white font-bold py-2 px-4 rounded hover:bg-gray-300 ml-2" id="cancelReportLostItems">Cancel</button>
                </div>
                <p id="reportSuccessMessage" class="text-green-600 mt-2 hidden">Report sent successfully!</p>
            </form>
        </div>
    </div>
</div>

<!-- Feedback Modal -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="feedbackModal">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h3 class="text-lg font-semibold mb-3">Give Feedback</h3>
            <form action="{{ route('submitFeedback') }}" method="post" id="feedbackForm">

                @csrf
                <div class="mb-4">
                    <label for="feedback" class="block text-sm font-medium text-gray-700">Your Feedback:</label>
                    <textarea id="feedback" name="feedback" rows="4" class="form-textarea mt-1 block w-full"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-800 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Submit</button>
                    <button type="button" class="bg-gray-400 text-white font-bold py-2 px-4 rounded hover:bg-gray-300 ml-2" id="cancelFeedback">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportLostItemsLink = document.getElementById('reportLostItemsLink');
            const reportLostItemsModal = document.getElementById('reportLostItemsModal');
            const cancelReportLostItems = document.getElementById('cancelReportLostItems');
            const reportSuccessMessage = document.getElementById('reportSuccessMessage');

            reportLostItemsLink.addEventListener('click', function(event) {
                event.preventDefault();
                reportLostItemsModal.classList.remove('hidden');
            });

            cancelReportLostItems.addEventListener('click', function(event) {
                event.preventDefault();
                reportLostItemsModal.classList.add('hidden');
            });

            const reportLostItemsForm = document.getElementById('reportLostItemsForm');
            reportLostItemsForm.addEventListener('submit', function(event) {
                event.preventDefault();
                // Simulate sending report data
                setTimeout(function() {
                    reportLostItemsModal.classList.add('hidden');
                    reportSuccessMessage.classList.remove('hidden');
                }, 1500);
            });

            const feedbackLink = document.getElementById('feedbackLink');
            const feedbackModal = document.getElementById('feedbackModal');
            const cancelFeedback = document.getElementById('cancelFeedback');

            feedbackLink.addEventListener('click', function(event) {
                event.preventDefault();
                feedbackModal.classList.remove('hidden');
            });

            cancelFeedback.addEventListener('click', function(event) {
                event.preventDefault();
                feedbackModal.classList.add('hidden');
            });

            const feedbackForm = document.getElementById('feedbackForm');

            feedbackForm.addEventListener('submit', function(event) {
                event.preventDefault();
                // Simulate submitting feedback
                setTimeout(function() {
                    feedbackModal.classList.add('hidden');
                }, 1500);
            });
        });
    </script>
@endsection
