@extends('admin.layout.main-layout')
@section('main-container')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Vendors -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Vendors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $vendors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories and Sub-Categories -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Categories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories }}</div>
                        </div>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sub Categories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sub_categories }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Product -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Orders & Amount Per User</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="form-check form-switch" style="--bs-form-switch-width:60px;--bs-form-switch-height:24px">
                        <input class="form-check-input" type="checkbox" role="switch" id="pie_chart_checkbox"
                            onchange="pieChartShowHide()" />
                        <label id='pie_chart_text' class="form-check-label ms-2" for="switchSizeLargeChecked">Switch To
                            Amount View</label>
                    </div>
                    <div class="chart-pie pt-4 pb-2" id="chart">
                        <canvas id="myPieChart"></canvas>
                        <canvas id="PieChart" hidden></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function pieChartShowHide() {
            let checkbox = document.getElementById('pie_chart_checkbox').checked;
            if (checkbox == true) {
                document.getElementById('pie_chart_text').innerHTML = 'Switch To Order View';
                document.getElementById('myPieChart').hidden = true;
                document.getElementById('PieChart').hidden = false;
            } else {
                document.getElementById('pie_chart_text').innerHTML = 'Switch To Amount View';
                document.getElementById('myPieChart').hidden = false;
                document.getElementById('PieChart').hidden = true;
            }
        }
    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    data: @json($data['data']),
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>

    <script>
        var ctx = document.getElementById('PieChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($amount_data['labels']),
                datasets: [{
                    data: @json($amount_data['data']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });
    </script>
@endsection
