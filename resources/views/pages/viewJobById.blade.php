<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <div class="jumbotron jumbotron-fluid mb-0 bg-info text-white">
        <div class="container">
            <h1 class="display-4 text-center" style="color:white;">{{ $jobName }}</h1>
            <p class="lead text-center">
                <button id="generate-pdf" class="btn btn-primary">Generate PDF For Todays Jobs</button>
                <a class="btn btn-light btn-lg text-center" href="/">Back</a>
            </p>
        </div>
    </div>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="mb-5 ps-3">
                        <h6 class="mb-1 text-center">Available Jobs</h6>
                    </div>
                    @if ($jobsWithDetails->isEmpty())
                        <p>No job records found.</p>
                    @else
                        <div class="container">
                            <div class="row">
                                @foreach ($jobsWithDetails->groupBy('date') as $date => $records)
                                    <div class="col-md-3 mb-4">
                                        <div class="card">
                                            <div class="card-header p-0 mt-n4 mx-6">
                                                <a class="d-block shadow-xl border-radius-xl">
                                                    <!-- You can add your image here -->
                                                </a>
                                            </div>
                                            <div class="card-body p-3">
                                                <h6 class="card-subtitle mb-2 text-center" style="color:black; text-decoration: underline;"> <!-- Add 'text-decoration: underline;' to underline the date -->
                                                    {{ \Carbon\Carbon::parse($date)->setTimezone('Europe/London')->format('l d-m-y') }}
                                                </h6>
                                                @foreach ($records as $record)
                                                    <div class="d-flex justify-content-between">
                                                        <h6 class="card-text" style="color:black;">Shift:</h6>
                                                        <p class="card-text" style="color:black;">{{ $record->shift }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <h6 class="card-text" style="color:black;">Total Number of People:</h6>
                                                        <p class="card-text" style="color:black;">{{ $record->total_num_people }}</p>
                                                    </div>
                                                    <hr> <!-- Add this line to insert an <hr> after each record -->
                                                @endforeach
                                                <div class="d-flex align-items-center justify-content-between mt-2">
                                                    <div class="avatar-group">
                                                        <!-- Add your avatars here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    document.getElementById('generate-pdf').addEventListener('click', function () {
        // Create a new jsPDF instance
        const doc = new jsPDF();
        // Loop through each card on the page
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            // Get the card content as HTML
            const cardContent = card.innerHTML;
            // Add a new page for each card except the first one
            if (index > 0) {
                doc.addPage();
            }
            // Add the card content to the PDF
            doc.fromHTML(cardContent, 10, 10);
        });
        // Save or open the PDF
        doc.save('jobs.pdf');
    });
</script>
