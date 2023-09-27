<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='We Choose To Care'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="mb-5 ps-3">
                        <h6 class="mb-1">Available Jobs</h6>
                    </div>
                    <div class="row">
                        @if ($jobsWithDetails->isEmpty())
                            <p>No job records found.</p>
                        @else
                            @foreach ($jobsWithDetails->groupBy('date') as $date => $records)
                                <div class="container">
                                    @if ($records->isEmpty())
                                        <p>No job records found for this date.</p>
                                    @else
                                        @foreach ($records as $record)
                                            <div class="col-md-4 mb-4">
                                                <div class="card">
                                                    <div class="card-header p-0 mt-n4 mx-3">
                                                        <a class="d-block shadow-xl border-radius-xl">
                                                            <!-- You can add your image here -->
                                                            <img src="{{ asset('assets') }}/img/team-1.jpg"
                                                                alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                                        </a>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <p class="mb-0 text-sm">Job Details</p>
                                                        <a href="javascript:;">
                                                            <h6 class="card-subtitle mb-2 text-muted">{{ $record->job }}</h6>
                                                            <p class="card-text">Shift: {{ $record->shift }}</p>
                                                            <p class="card-text">Total Number of People: {{ $record->total_num_people }}</p>
                                                        </a>
                                                        <p class="mb-4 text-sm">
                                                            <!-- Add your content here -->
                                                        </p>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="avatar-group mt-2">
                                                                <!-- Add your avatars here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
