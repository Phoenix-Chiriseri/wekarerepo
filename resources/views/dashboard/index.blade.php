<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <script>
            function generatePDF() {
                var doc = new jsPDF();
                // HTML content to be converted
                var htmlContent = document.getElementById('pdf-content').innerHTML;
                doc.text('Daily Statistics Report', 10, 10); // Title
                doc.fromHTML(htmlContent, 10, 20, {
                    width: 190
                });
                // Save the PDF
                doc.save('JobsReport.pdf');
            }
            </script>
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="All Jobs"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-xl-6 mb-xl-0 mb-4">
                            <div class="card bg-transparent shadow-xl">
                                <div class="overflow-hidden position-relative border-radius-xl">
                                    <img src=""
                                        class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100"
                                        alt="">
                                    <span class="mask bg-gradient-dark opacity-10"></span>
                                    <div class="card-body position-relative z-index-1 p-3">
                                        <h5 class="text-white mt-4 mb-5 pb-2">
                                        Welcome {{$name}}
                                        </h5>
                                        <hr>
                                        <button onclick="generatePDF()" class = "btn btn-success btn-lg"><i class = "fa fa-print"></i>Export Jobs List</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="card">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">account_balance</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            <h6 class="text-center mb-0">Jobs Count</h6>
                                            <span class="text-xs"></span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">{{$numberOfJobs}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="card">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">account_balance_wallet</i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            <h6 class="text-center mb-0">Last Job Entered</h6>
                                            <hr class="horizontal dark my-3">
                                            @if($latest)
                                                <h5 class="mb-0">{{ $latest->job }}</h5>
                                            @else
                                                <h5 class="mb-0">No Job Found</h5>
                                            @endif
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card mt-4">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                          
                                        </div>
                                        <div class="col-6 text-end">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-md-0 mb-4">
                                            <div>
                                               
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    
                                </div>
                                <div class="col-6 text-end">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <img src="{{ asset('assets') }}/img/wekareLogo.png"
                            alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                        </div>
                    </div>
                </div>
            </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Available Jobs</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0"  id = "pdf-content">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase  text-xxs font-weight-bolder" style="color:black;">Name</th>
                                            <th class="text-uppercase  text-xxs font-weight-bolder" style="color:black;">Created At</th>
                                            <th class="text-uppercase  text-xxs font-weight-bolder" style="color:black;">Updated At</th>
                                            <th class="text-uppercase  text-xxs font-weight-bolder" style="color:black;">Add Job Details</th>
                                            <th class="text-uppercase  text-xxs font-weight-bolder" style="color:black;">Delete Job</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0" style="color:black;">{{ $job->job }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0" style="color:black;">{{ $job->created_at }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs mb-0" style="color:black;">{{ $job->updated_at }}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user" style="color:black;">
                                                        <a href="{{ '/editJob/'. $job->id }}" class = "btn btn btn-outline-dark"><i class = "fa fa-plus"></i>Add</a>
                                                    </a>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user" style="color:black;">
                                                        <a href="{{ '/deleteJob/'. $job->id }}" class = "btn btn-dark btn-link"><i class = "fa fa-trash"></i>Delete</a>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                            {{ $jobs->links() }}
                        </div>
                    </div>
                </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
