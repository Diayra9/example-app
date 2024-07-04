<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Category</title>
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
                            <p class="card-header-title has-text-white">FORM KATEGORI</p>
                        </header>

                        <div class="card-content">
                            <form id="categoryForm" action="{{ url('save-category') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="field">
                                    <label class="label">Nama Kategori</label>
                                    <div class="control">
                                        <input name="category" class="input is-rounded" type="text" placeholder="Isi keterangan disini..." required />
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
        document.getElementById('categoryForm').addEventListener('submit', function(event) {
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