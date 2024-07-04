<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
@include('header')
    <section class="hero">
        <div class="hero-body columns">
            @include('navigation')
            <main class="column">
                <div class="card has-background-primary-light">
                    <header class="card-header has-background-info">
                        <p class="card-header-title has-text-white">FORM TRANSAKSI</p>
                    </header>

                    <div class="card-content">
                        <form id="transactionForm" action="{{ url('save-transaction') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="field">
                                <label class="label">Nominal</label>
                                <div class="control">
                                    <input name="nominal" class="input is-rounded" type="number" step="0.01" placeholder="Isi nominal angka disini..." required />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Deskripsi</label>
                                <div class="control">
                                    <textarea name="description" class="textarea" placeholder="Isi deskripsi transaksi disini..."></textarea>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Tanggal</label>
                                <div class="control">
                                    <input name="date" class="input is-rounded" type="date" required />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Pilih Kategori</label>
                                <div class="control select is-rounded is-info">
                                    <select name="category_id" required>
                                        <option value="" disabled selected>--Pilih Kategori--</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Pilih Wallet</label>
                                <div class="control select is-rounded is-info">
                                    <select name="wallet_id" required>
                                        <option value="" disabled selected>--Pilih Wallet--</option>
                                        @foreach($wallets as $wallet)
                                        <option value="{{ $wallet->wallet_id }}">{{ $wallet->name }} - Rp.{{ $wallet->saldo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Status Transaksi</label>
                                <div class="control select is-rounded is-info">
                                    <select name="status" required>
                                        <option value="" disabled selected>--Pilih--</option>
                                        <option value="1">Masuk</option>
                                        <option value="0">Keluar</option>
                                    </select>
                                </div>
                            </div>

                            <button class="button is-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <!-- Sweet Alert untuk Submit -->
    <script>
        document.getElementById('transactionForm').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`,
                customClass: {
                    confirmButton: 'button is-success',
                    denyButton: 'button is-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Saved!", "", "success").then(() => {
                        event.target.submit();
                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });
    </script>
@include('footer')
</body>

</html>
