<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <div class="col-10">
                        <h4 class="card-title mb-0 flex-grow-1">Thống kê doanh thu</h4>
                    </div>
                    <div class="col-2">
                        <select class="form-select" wire:model='year' name="year" wire:change='updateChart'>
                            @foreach ($getYear as $row)
                                <option {{ $row->year == $selectedYear ? 'selected' : '' }} value="{{ $row->year }}">
                                    Năm {{ $row->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!-- end card header -->

                <div class="card-body p-0 pb-2">
                    <div class="w-100">
                        <!-- Include Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <!-- Create a canvas element for the chart -->
                        <canvas id="myChart" class=" p-4" height="400px"></canvas>

                        <!-- Your other HTML content -->

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div>
    <div wire:ignore>
        <script>
            document.addEventListener('livewire:init', () => {
                var myChart;
                Livewire.on('mountUpdated', function(data) {
                    paymentData = data[0].mount;
                    if (paymentData && paymentData.length > 0) {
                        var labels = paymentData.map(payment => "Tháng " + payment.month);
                        var amounts = paymentData.map(payment => payment.total);
                        if (myChart) {
                            myChart.data.labels = labels;
                            myChart.data.datasets[0].data = amounts;
                            myChart.update();
                        } else {
                            var ctx = document.getElementById('myChart').getContext('2d');
                            myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Tổng doanh thu',
                                        data: amounts,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });
                        }
                    }
                });
            });
        </script>
    </div>
</div>
