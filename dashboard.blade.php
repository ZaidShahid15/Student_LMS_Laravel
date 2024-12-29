@extends('app.app')

@section('main')
     <!-- Main Content -->
     <div class="main-box">
        {{-- <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4" style="height: 200vh">
                    <div class="card p-4 bg-transparent shadow">
                        <h1>Welcome {{ Auth::user()->name }}!</h1>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-md-12">
            <div class="container ">
                <div class="row">
                    <!-- Welcome Card -->
                    <div class="col-md-12">
                        <div class="card p-2 shadow text-center align-items-center d-flex flex-coloumn bg-light select-text- mb-4">
                           <div class="mt-3">
                            <h2 class="fw-bold heading" style="font-size: 31px;">Welcome {{ Auth::user()->name }}!</h2>
                            <p class="lead" style="font-size: 17px; margin-top:-9px;">Here's an overview of your dashboard.</p>
                           </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="col-md-4">
                        <div class="card p-2 shadow  text-white text-center mb-4" style="background-color:#7E909A ">
                            <h3>Total Students</h3>
                            <p class="display-4">{{ $user }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-2 shadow text-white text-center mb-4" style="background-color: #1C4E80;">
                            <h3>Total Books</h3>
                            <p class="display-4">{{ $totalibooks }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-2 shadow  text-white text-center mb-4" style="background-color: #DBAE58">
                            <h3>Issued Books</h3>
                            <p class="display-4">{{ $totalIssuedBooks }}</p>
                        </div>
                    </div>



                    <!-- Chart Example (Optional) -->
                    <div class="col-md-12">
                        <div class="card p-4 shadow mb-4">
                            <h3>Performance Chart</h3>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Performance',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
