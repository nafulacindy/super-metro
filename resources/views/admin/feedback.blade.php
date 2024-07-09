@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-4">Feedback Details</h2>
        
        <div>
            <!-- Display feedback details -->
            <h3 class="text-lg font-semibold mb-3">Feedback</h3>
            @foreach($feedbacks as $feedback)
                <p>{{ $feedback->feedback }}</p>
            @endforeach
        </div>

        <div class="mt-8">
            <!-- Display lost item report details -->
            <h3 class="text-lg font-semibold mb-3">Lost Item Reports</h3>
            @foreach($lostItemReports as $report)
                <p>Bus Registration: {{ $report->bus_registration }}</p>
                <p>Travel Date: {{ $report->travel_date }}</p>
                <p>Luggage Description: {{ $report->luggage_description }}</p>
                <hr class="my-4">
            @endforeach
        </div>
    </div>
@endsection
