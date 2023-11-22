<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <div class="col-10">
                        <h4 class="card-title mb-0 flex-grow-1">Thống kê</h4>
                    </div>
                    <div class="col-2">
                        <select class="form-select" wire:model.live='updateChart'>
                            @foreach ($year as $row)
                                <option {{ $row->year == $selectedYear ? 'selected' : '' }} value="{{ $row->year }}">
                                    Năm {{ $row->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><!-- end card header -->
                <div class="card-header p-0 border-0 bg-light-subtle">
                    <div class="row g-0 text-center">
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span></h5>
                                <p class="text-muted mb-0">Orders</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k</h5>
                                <p class="text-muted mb-0">Earnings</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="367">0</span></h5>
                                <p class="text-muted mb-0">Refunds</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-3">
                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                <h5 class="mb-1 text-success"><span class="counter-value" data-target="18.92">0</span>%
                                </h5>
                                <p class="text-muted mb-0">{{ $updateChart }}123</p>

                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div><!-- end card header -->

                <div class="card-body p-0 pb-2">
                    <div class="w-100">
                        <!-- Include Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <!-- Create a canvas element for the chart -->
                        <canvas id="myChart" class="p-4"></canvas>

                        <!-- Your other HTML content -->

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div>
    <script>
        // Assuming $mount is an array of payment data
        var paymentData = @json($mount);

        // Extract necessary data for the chart
        var labels = paymentData.map(payment => payment.month);
        var amounts = paymentData.map(payment => payment.total);

        // Create the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tổng tiền ',
                    data: amounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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

</div>
