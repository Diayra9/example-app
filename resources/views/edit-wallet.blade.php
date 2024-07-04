<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Wallet</title>
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
                        <p class="card-header-title has-text-white">FORM EDIT WALLET</p>
                    </header>

                    <div class="card-content">
                        <form id="walletForm" action="{{ url('update-wallet/'.$wallet->wallet_id) }}" method="POST">
                            {{ csrf_field() }}

                            <div class="field">
                                <label class="label">Nama Wallet</label>
                                <div class="control">
                                    <input name="name" class="input is-rounded" type="text" placeholder="Isikan nama disini....." value="{{ $wallet->name }}" />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Saldo</label>
                                <div class="control">
                                    <input name="saldo" class="input is-rounded" type="number" placeholder="Saldo anda dapat dilihat disini." value="{{ $wallet->saldo }}" readonly />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Deskripsi</label>
                                <div class="control">
                                    <textarea name="description" class="textarea" placeholder="Isikan deskripsi disini.....">{{ $wallet->description }}</textarea>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Status Transaksi</label>
                                <div class="control dropdown is-active select is-rounded is-info">
                                    <select name="status">
                                        <option value="1" @if($wallet->status == 1) selected @endif>Aktif</option>
                                        <option value="0" @if($wallet->status != 1) selected @endif>Tidak Aktif</option>
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
        document.getElementById('walletForm').addEventListener('submit', function(event) {
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
                    window.location.href = '{{ url("list-wallet") }}';
                }
            });
        });
    </script>
@include('footer')
</body>

</html>
