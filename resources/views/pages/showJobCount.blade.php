@section('content')
    <!-- Your HTML content here -->
    @foreach ($jobWithDetails as $detail)
        <p>Job: {{ $detail->job }}</p>
        <p>Date: {{ $detail->date }}</p>
        <p>Shift: {{ $detail->shift }}</p>
        <p>Total Number of People: {{ $detail->total_num_people }}</p>
    @endforeach
</section>
