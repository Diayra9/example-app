<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Wallet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @include('header')
    <section class="hero">
        <div class="hero-body">
            <div class="columns">
                @include('navigation')
                <main class="column">
                    <div class="card has-background-primary-light">
                        <header class="card-header has-background-info">
                            <p class="card-header-title has-text-white">FORM WALLET</p>
                        </header>

                        <div class="card-content">
                            <form id="walletForm" action="{{ url('save-wallet') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="field">
                                    <label class="label">Jenis Wallet</label>
                                    <div class="control">
                                        <input name="name" class="input is-rounded" type="text" placeholder="Isikan nama wallet disini....." required />
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Deskripsi</label>
                                    <div class="control">
                                        <textarea name="description" class="textarea" placeholder="Isikan deskripsi disini....."></textarea>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Status</label>
                                    <div class="control select is-rounded is-info">
                                        <select name="status" required>
                                            <option value="" disabled selected>--Status--</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="button is-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <!-- Sweet Alert untuk Submit -->
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
    </script>
@include('footer')
</body>

</html>