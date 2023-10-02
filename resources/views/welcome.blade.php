<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<x-layout bodyClass="bg-gray-200" style="margin-top: 22px;">
    <div class="container" style="margin-top: 100px;">
        <div class="row mx-auto">
            <div class="col-md-6 offset-md-2">
                <form action="{{ route('search-job') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control border border-2 p-2" id="textbox" name="search_job" placeholder="Search Job">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success btn-sm">Search</button>
                </div>
                </form>
            </div>
        </div>
    </div>  
    <div class="main-content d-flex justify-content-center align-items-center bg-gray-100 min-vh-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 mt-4">
                    <div class="mb-5 ps-3 text-center">
                        <h4 class="mb-1">Available Jobs</h4>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($jobs as $job)
                        <div class="col-xl-4 col-md-6 mb-xl-4 mb-4">
                            <div class="card card-cascade narrower">
                                <!-- Card image -->
                                <div class="view view-cascade overlay">
                                    <img src="{{ asset('assets') }}/img/weKareLogo.png" class="card-img-top"
                                        alt="img-blur-shadow">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                
                                <!-- Card content -->
                                <div class="card-body card-body-cascade">
                                    <p class="mb-0 text-sm">Job Name</p>
                                    <a href="javascript:;">
                                        <h5>{{ $job->job }}</h5>
                                    </a>
                                    <p class="mb-2 text-sm"></p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-1 text-sm" style="color:black;">Job Created At (UK Time):</p>
                                            <p class="text-sm" style="color: black;">
                                                {{ \Carbon\Carbon::parse($job->created_at)->setTimezone('Europe/London')->format('l d-m-y H:i:s') }}
                                            </p>
                                        </div>
                                        <a type="button" href="{{ '/viewJob/'. $job->id }}" class="btn btn-success btn-sm mb-0"><i class="fa fa-users fa-2x"></i>View Workers</a>
                                    </div>
                                    <div class="avatar-group mt-2">
                                        <!-- Add your avatar images here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<style>
    .main-content {
        min-height: 100vh;
    }

    .card-blog {
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        border: none;
    }
</style>
