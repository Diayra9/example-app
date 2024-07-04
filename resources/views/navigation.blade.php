<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
</head>

<body>
    <aside class="column is-narrow">
        <div class="menu">
            <p class="menu-label">Welcome, Admin!</p>
            <ul class="menu-list">
                <li>
                    <a href="{{ url('home') }}">
                        <i class="fas fa-home"></i>
                        Beranda</a>
                </li>
                <li>
                    <a href="{{ url('viewTransaction') }}">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Transaksi</a>
                </li>
                <li>
                    <a href="{{ url('viewCategory') }}">
                        <i class="fas fa-folder-plus"></i>
                        Tambah Kategori</a>
                </li>
                <li>
                    <a href="{{ url('viewWallet') }}">
                        <i class="fas fa-wallet"></i>
                        Tambah Wallet</a>
                </li>
                <li>
                    <a href="{{ url('list-transaction') }}">
                        <i class="fas fa-list"></i>
                        List Transaksi</a>
                </li>
                <li>
                    <a href="{{ url('list-category') }}">
                        <i class="fas fa-list"></i>
                        List Kategori</a>
                </li>
                <li>
                    <a href="{{ url('list-wallet') }}">
                        <i class="fas fa-list"></i>
                        List Wallet</a>
                </li>
                <li>
                    <a href="{{ url('viewReport') }}">
                        <i class="fas fa-chart-bar"></i>
                        Rekap Transaksi</a>
                </li>
            </ul>
        </div>
    </aside>
</body>

</html>