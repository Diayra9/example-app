<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @include('header')

    <section class="hero">
        <div class="hero-body columns">
            @include('navigation')
            <div class="column is-three-quarters">
                <div class="box has-background-info-light">
                    <h2 class="title">Transaksi Terbaru</h2>
                    <div class="content">
                        @foreach ($transactions as $transaction)
                        <ul>
                            {{ $loop->iteration }}.
                            <strong>@if ($transaction->status == 1)
                                Transaksi Masuk
                                @else
                                Transaksi Keluar
                                @endif</strong>
                            Rp. {{ $transaction->nominal }} - {{ $transaction->wallet->name }}, saldo tersimpan Rp. {{ $transaction->wallet->saldo }}
                        </ul>
                        @endforeach
                        <div class="is-flex is-justify-content-flex-end">
                            <a href="{{ url('list-transaction') }}" class="button is-info">Detail</a>
                        </div>
                    </div>
                </div>
                
                <div class="box has-background-info-light">
                    <h2 class="title">Statistik Transaksi Berdasarkan Hari</h2>
                    <canvas id="myChartByWallet" width="400" height="200"></canvas>
                </div>

                <div class="box has-background-info-light">
                    <h2 class="title">Pengingat</h2>
                    <div class="content">
                        <p><strong>Perhatian:</strong> Pastikan untuk memverifikasi semua transaksi sebelum
                            disimpan.</p>
                        <p>Jika ada transaksi yang tidak sesuai, segera hubungi untuk perbaikan. <strong>Kontak kami:</strong></p>
                        <p>
                            <a href="mailto:dianayurahmawati006@gmail.com">
                                <i class="fas fa-envelope"></i> dianayurahmawati006@gmail.com
                            </a>
                        </p>
                        <p>
                            <a href="https://t.me/AriadnaPreAgrigent" target="_blank">
                                <i class="fab fa-telegram-plane"></i> +62 857-3097-5244
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('footer')

    <div id="chart-data" data-labels-by-wallet='@json($labelsByWallet)' data-datasets-by-wallet='@json($datasetsByWallet)'>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var labelsByWallet = JSON.parse(document.getElementById('chart-data').dataset.labelsByWallet);
            var datasetsByWallet = JSON.parse(document.getElementById('chart-data').dataset.datasetsByWallet);

            createChart('myChartByWallet', labelsByWallet, datasetsByWallet);
        });

        function createChart(canvasId, labels, datasets) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            const config = {
                type: 'bar',
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
</body>

</html>