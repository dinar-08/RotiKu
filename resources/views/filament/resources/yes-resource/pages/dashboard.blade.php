<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Area Chart --}}
        <div class="md:col-span-2 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Earnings Overview</h2>
            <canvas id="areaChart" class="w-full h-64"></canvas>
        </div>

        {{-- Pie Chart --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Revenue Sources</h2>
            <canvas id="pieChart" class="w-full h-64 mb-4"></canvas>
            <div class="text-center text-sm space-x-2">
                <span class="inline-block text-blue-500">● Direct</span>
                <span class="inline-block text-green-500">● Social</span>
                <span class="inline-block text-cyan-500">● Referral</span>
            </div>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Chart Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Area Chart
            const areaCtx = document.getElementById("areaChart").getContext("2d");
            new Chart(areaCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Pendapatan',
                        data: [120000, 90000, 140000, 130000, 160000, 180000],
                        backgroundColor: 'rgba(78, 115, 223, 0.2)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    }
                }
            });

            // Pie Chart
            const pieCtx = document.getElementById("pieChart").getContext("2d");
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Direct', 'Social', 'Referral'],
                    datasets: [{
                        label: 'Source',
                        data: [55, 30, 15],
                        backgroundColor: [
                            '#4e73df',
                            '#1cc88a',
                            '#36b9cc'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
</x-filament::page>
