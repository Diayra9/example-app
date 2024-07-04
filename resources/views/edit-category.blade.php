<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kategori</title>
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
                        <p class="card-header-title has-text-white">FORM EDIT KATEGORI</p>
                    </header>

                    <div class="card-content">
                        <form id="categoryForm" action="{{ url('update-category/'.$category->category_id) }}" method="POST">
                            {{ csrf_field() }}

                            <div class="field">
                                <label class="label">Nama Kategori</label>
                                <div class="control">
                                    <input name="category" class="input is-rounded" type="text" placeholder="Isi kategori disini..." value="{{ $category->category }}" />
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
                    window.location.href = '{{ url("list-category") }}';
                }
            });
        });
    </script>
@include('footer')
</body>

</html>
