@extends('app.app')

@section('main')
    <!-- Main Content -->
    <div class="main-box">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <!-- Welcome Card -->
                    <div class="col-md-12">
                        <div class="card p-2 shadow text-center align-items-center d-flex flex-column bg-light mb-4">
                            <div class="mt-3">
                                <h2 class="fw-bold heading" style="font-size: 31px;">Welcome {{ Auth::user()->name }}!</h2>
                                <p class="lead" style="font-size: 17px; margin-top:-9px;">Here's an overview of your library dashboard.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="col-md-6">
                        <div class="card p-2 shadow text-white text-center mb-4" style="background-color:#1C4E80;">
                            <h3>Total Books</h3>
                            <p class="display-4 " >{{ $book }}</p>
                            <input type="hidden" id="book" value="{{ $book }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-2 shadow text-white text-center mb-4" style="background-color:#DBAE58;">
                            <h3>Issued Books</h3>
                            <p class="display-4" >{{ $totalIssuedBooks }}</p>
                            <input type="hidden" id="issued" value="{{ $totalIssuedBooks }}">

                        </div>
                    </div>

                    <!-- Graph Card -->
                    <div class="col-md-12">
                        <div class="card p-4 shadow mb-4">
                            <h3>Books Overview</h3>
                            <canvas id="booksChart"></canvas>
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
    const ctx = document.getElementById('booksChart').getContext('2d');
    var book = document.getElementById('book').value;
    var issued = document.getElementById('issued').value;
    const booksChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Books', 'Issued Books'],
            datasets: [{
                label: 'Books Count',
                data: [book, issued],  // Dynamic values can be inserted here
                backgroundColor: [
                    'rgba(28, 78, 128, 0.6)', // Total Books color
                    'rgba(219, 174, 88, 0.6)', // Issued Books color
                ],
                borderColor: [
                    'rgba(28, 78, 128, 1)',
                    'rgba(219, 174, 88, 1)',
                ],
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
