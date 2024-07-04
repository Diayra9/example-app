<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
@include('header')
    <section class="hero">
        <div class="hero-body columns">
            @include('navigation')
            <main class="column">
                <div class="card has-background-link-light">
                    <header class="card-header has-background-link">
                        <p class="card-header-title has-text-white">FORM EDIT TRANSAKSI</p>
                    </header>

                    <div class="card-content">
                        <form id="transactionForm" action="{{ url('update-transaction/'.$transaction->transaction_id) }}" method="POST">
                            {{ csrf_field() }}

                            <div class="field">
                                <label class="label">Nominal</label>
                                <div class="control">
                                    <input name="nominal" class="input is-rounded" type="text" placeholder="Isi nominal angka disini..." value="{{ $transaction->nominal }}" />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Deskripsi</label>
                                <div class="control">
                                    <textarea name="description" class="textarea" placeholder="Isi deskripsi transaksi disini...">{{ $transaction->description }}</textarea>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Tanggal</label>
                                <div class="control">
                                    <input name="date" class="input is-rounded" type="date" value="{{ $transaction->date }}" />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Pilih Kategori</label>
                                <div class="control select is-rounded is-info">
                                    <select name="category_id">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}" @if($transaction->category_id == $category->category_id) selected @endif>{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Pilih Wallet</label>
                                <div class="control select is-rounded is-info">
                                    <select name="wallet_id">
                                        @foreach($wallets as $wallet)
                                        <option value="{{ $wallet->wallet_id }}" @if($transaction->wallet_id == $wallet->wallet_id) selected @endif>{{ $wallet->name }} - Rp.{{ $wallet->saldo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Status Transaksi</label>
                                <div class="control dropdown is-active select is-rounded is-info">
                                    <select name="status">
                                        <option value="1" @if($transaction->status == 1) selected @endif>Masuk</option>
                                        <option value="0" @if($transaction->status != 1) selected @endif>Keluar</option>
                                    </select>
                                </div>
                            </div>

                            <div class="buttons">
                                <button class="button is-link" type="submit">Simpan</button>
                                <button class="button is-danger" type="button" id="cancelButton">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </section>

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

        document.getElementById('cancelButton').addEventListener('click', function() {
            Swal.fire({
                title: "Are you sure?",
                text: "All unsaved changes will be lost.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, leave",
                cancelButtonText: "No, stay",
                customClass: {
                    confirmButton: 'button is-danger',
                    cancelButton: 'button is-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ url("list-transaction") }}';
                }
            });
        });
    </script>
@include('footer')
</body>

</html>
