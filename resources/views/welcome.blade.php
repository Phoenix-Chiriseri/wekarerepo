<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<x-layout bodyClass="bg-gray-200" style="margin-top: 22px;">
    <div class="main-content d-flex justify-content-center align-items-center bg-gray-100 min-vh-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 mt-4">
                    <div class="mb-5 ps-3 text-center">
                        <h6 class="mb-1">Available Jobs</h6>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($jobs as $job)
                        <div class="col-xl-3 col-md-6 mb-xl-4 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="card-header p-0 mt-n4 mx-3">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="{{ asset('assets') }}/img/wctclogo.png"
                                            alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <p class="mb-0 text-sm">Job Name</p>
                                    <a href="javascript:;">
                                        <h5>
                                            {{ $job->job }}
                                        </h5>
                                    </a>
                                    <p class="mb-4 text-sm"> 
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a type="button" href ="{{ '/viewJob/'. $job->id }}" class="btn btn-outline-primary btn-sm mb-0"><i class = "fa fa-users fa-2x"></i>View Workers</a>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="">
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets') }}/img/team-1.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="">
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets') }}/img/team-2.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="">
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets') }}/img/team-3.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="">
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets') }}/img/team-4.jpg">
                                            </a>
                                        </div>
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
