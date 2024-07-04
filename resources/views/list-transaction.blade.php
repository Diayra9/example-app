<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
@include('header')
    <section class="hero">
        <div class="hero-body">
            <div class="columns">
                @include('navigation')
                <div class="column is-10">
                    <div class="card has-background-primary-light">
                        <header class="card-header has-background-info">
                            <p class="card-header-title has-text-white">LIST RIWAYAT TRANSAKSI</p>
                            
                            <!-- Penyortiran Berdasarkan Bulan -->
                            <div class="card-content">
                                <form method="GET" action="{{ url('list-transaction') }}">
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <div class="select is-rounded">
                                                <select name="month" onchange="this.form.submit()"> <!-- Halaman diperbarui otomatis dengan filter -->
                                                    <option value="">Pilih Bulan</option>
                                                    @for ($month = 1; $month <= 12; $month++)
                                                        <!--- Mengubah nomor bulan $m (1-12) menjadi nama bulan -->
                                                        <option value="{{ $month }}" @if(request('month') == $month) selected @endif>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </header>

                        <!-- Isi Data -->
                        <div class="card-content">
                            <table class="table is-bordered is-hoverable is-fullwidth">
                                <thead>
                                    <tr>
                                        <th class="has-text-centered">No.</th>
                                        <th class="has-text-centered">Nominal</th>
                                        <th class="has-text-centered">Deskripsi</th>
                                        <th class="has-text-centered">Tanggal</th>
                                        <th class="has-text-centered">Kategori</th>
                                        <th class="has-text-centered">Wallet</th>
                                        <th class="has-text-centered">Status</th>
                                        <th class="has-text-centered">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr class="has-text-centered">
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>Rp. {{ $transaction->nominal }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>{{ $transaction->category->category }}</td>
                                        <td>{{ $transaction->wallet->name }}</td>
                                        <td>
                                            @if ($transaction->status == 1)
                                            Transaksi Masuk
                                            @else
                                            Transaksi Keluar
                                            @endif
                                        </td>
                                        <td>
                                            <div class="buttons is-centered">
                                                <a class="button is-small is-info" href="{{ url('edit-transaction/'.$transaction->transaction_id) }}" onclick="return confirmEdit(event, '{{ $transaction->description }}')">Edit</a>
                                                <form action="{{ url('delete-transaction/'.$transaction->transaction_id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event, '{{ $transaction->description }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button is-small is-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sweet Alert untuk Delete dan Edit -->
    <script>
        function confirmEdit(event, description) {
            event.preventDefault(); // Default action

            Swal.fire({
                title: 'Are you sure?',
                text: `You can only edit the description.\nDo you want to edit the transaction: '${description}'?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, edit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'button is-success',
                    cancelButton: 'button is-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.target.href;
                }
            });
        }

        function confirmDelete(event, description) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: `You won't be able to revert this!\nDo you want to delete the transaction: '${description}'?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'button is-danger',
                    cancelButton: 'button is-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                        customClass: {
                            confirmButton: 'button is-success'
                        }
                    }).then(() => {
                        event.target.submit();
                    });
                }
            });
        }
    </script>
@include('footer')
</body>

</html>
