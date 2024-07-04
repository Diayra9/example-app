<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekap Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @include('header')
    <section class="hero">
        <div class="hero-body">
            <div class="columns">
                @include('navigation')
                <div class="column">
                    <div class="box has-background-info-light">
                        <p class="title is-5 has-text-centered">Per Kategori</p>
                        <canvas id="myChartByCategory"></canvas>
                    </div>
                </div>
                <div class="column">
                    <div class="box has-background-info-light">
                        <p class="title is-5 has-text-centered">Per Wallet</p>
                        <canvas id="myChartByWallet"></canvas>
                    </div>
                </div>
            </div>

            <!-- Memanggil Data -->
            <div
                id="chart-data"
                data-labels-by-category='@json($labelsByCategory)'
                data-datasets-by-category='@json($datasetsByCategory)'
                data-labels-by-wallet='@json($labelsByWallet)'
                data-datasets-by-wallet='@json($datasetsByWallet)'>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var labelsByCategory = JSON.parse(document.getElementById('chart-data').dataset.labelsByCategory);
                    var datasetsByCategory = JSON.parse(document.getElementById('chart-data').dataset.datasetsByCategory);
                    var labelsByWallet = JSON.parse(document.getElementById('chart-data').dataset.labelsByWallet);
                    var datasetsByWallet = JSON.parse(document.getElementById('chart-data').dataset.datasetsByWallet);

                    createChart('myChartByCategory', labelsByCategory, datasetsByCategory);
                    createChart('myChartByWallet', labelsByWallet, datasetsByWallet);
                });

                function createChart(canvasId, labels, datasets) {
                    const ctx = document.getElementById(canvasId).getContext('2d');
                    const config = {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: datasets,
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return value.toLocaleString('id-ID');
                                        }
                                    }
                                }
                            }
                        }
                    };
                    new Chart(ctx, config);
                }
            </script>
        </div>
    </section>
    @include('footer')
</body>

</html>