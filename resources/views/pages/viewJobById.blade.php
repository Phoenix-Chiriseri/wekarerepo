<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <div class="jumbotron jumbotron-fluid mb-0 bg-info text-white">
        <div class="container">
            <h1 class="display-4 text-center" style="color:white;">Jobs Available</h1>
            <p class="lead text-center">
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
                        @foreach ($jobsWithDetails->groupBy('date') as $date => $records)
                            <div class="container">
                                <div class="row shadow-lg">
                                    <div class="col-md-12 mb-4">
                                        <div class="card">
                                            <div class="card-header p-0 mt-n4 mx-6">
                                                <a class="d-block shadow-xl border-radius-xl">
                                                    <!-- You can add your image here -->
                                                </a>
                                            </div>
                                            <div class="card-body p-3">
                                                <h6 class="card-subtitle mb-2 text-center">{{ \Carbon\Carbon::parse($date)->setTimezone('Europe/London')->format('d-m-y') }}</h6>
                                                @foreach ($records as $record)
                                                    <h6 class="card-subtitle mb-2 text-muted text-center">{{ $record->job }}</h6>
                                                    <p class="card-text text-center">Shift: {{ $record->shift }}</p>
                                                    <p class="card-text text-center">Total Number of People: {{ $record->total_num_people }}</p>
                                                @endforeach
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="avatar-group mt-2">
                                                        <!-- Add your avatars here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
