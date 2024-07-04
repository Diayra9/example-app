<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jenis Wallet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
@include('header')
    <section class="hero">
        <div class="hero-body">
            <div class="columns">
                @include('navigation')
                <div class="column is-8">
                    <div class="card has-background-primary-light">
                        <header class="card-header has-background-info">
                            <p class="card-header-title has-text-white">LIST WALLET</p>
                        </header>

                        <!-- Isi Data -->
                        <div class="card-content">
                            <table class="table is-bordered is-hoverable is-fullwidth">
                                <thead>
                                    <tr>
                                        <th class="has-text-centered">No.</th>
                                        <th class="has-text-centered">Nama</th>
                                        <th class="has-text-centered">Saldo</th>
                                        <th class="has-text-centered">Deskripsi</th>
                                        <th class="has-text-centered">Status</th>
                                        <th class="has-text-centered">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($wallets as $wallet)
                                    <tr class="has-text-centered">
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $wallet->name }}</td>
                                        <td>Rp. {{ $wallet->saldo }}</td>
                                        <td>{{ $wallet->description }}</td>
                                        <td>
                                            @if ($wallet->status == 1)
                                            Aktif
                                            @else
                                            Tidak Aktif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="buttons is-centered">
                                                <a class="button is-small is-info" href="{{ url('edit-wallet/'.$wallet->wallet_id) }}" onclick="return confirmEdit(event)">Edit</a>
                                                <form action="{{ url('delete-wallet/'.$wallet->wallet_id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event)">
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
        function confirmEdit(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to edit the wallet?',
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

        function confirmDelete(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!\nDo you want to delete the wallet?',
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
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success',
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
