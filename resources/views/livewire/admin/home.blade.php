<div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <div class="col-10">
                        <h4 class="card-title mb-0 flex-grow-1">Thống kê người dùng</h4>
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
                <!-- Include Chart.js -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <div class="card-body p-0 pb-2">
                    <div class="w-100" wire:ignore>
                        <!-- Create a canvas element for the chart -->
                        <canvas id="userChart" class=" p-4" height="300"></canvas>

                        <!-- Your other HTML content -->

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <div class="col-12">
                        <h4 class="card-title mb-0 flex-grow-1">Thống kê khóa học</h4>
                    </div>
                </div><!-- end card header -->

                <div class="card-body p-0 pb-2">
                    <div class="w-100">
                        <!-- Create a canvas element for the chart -->
                        <canvas id="courseChart"  class=" p-4" height="320"></canvas>

                        <!-- Your other HTML content -->

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    
    <script wire:ignore>
        var paymentData = @json($course);

        // Lấy labels từ các khóa của đối tượng
        var labels = Object.keys(paymentData).map(month => "Danh mục " + month);

        // Lấy amounts từ các giá trị của đối tượng
        var amounts = Object.values(paymentData);
        var ctx = document.getElementById('courseChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tổng khóa học',
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
                maintainAspectRatio: false
            }
        });
    </script>
    <div wire:ignore>
        <script>
            document.addEventListener('livewire:init', () => {
                var userChart;
                Livewire.on('userUpdated', function(data) {
                    user = data[0].user;
                    console.log(user);
                    if (user) {
                        var labels = Object.keys(user).map(month => "Tháng " + month);
                        var amounts = Object.values(user).map(count => count);
                        if (userChart) {
                            userChart.data.labels = labels;
                            userChart.data.datasets[0].data = amounts;
                            userChart.update();

                        } else {
                            var ctx = document.getElementById('userChart').getContext('2d');
                            userChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Số người dùng',
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
                                    maintainAspectRatio: false
                                }
                            });
                        }
                    }
                });
            });
        </script>
    </div>
</div>
