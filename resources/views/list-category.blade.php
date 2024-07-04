<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jenis Kategori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
@include('header')
    <section class="hero">
        <div class="hero-body">
            <div class="columns">
                @include('navigation')
                <div class="column is-5">
                    <div class="card has-background-primary-light">
                        <header class="card-header has-background-info">
                            <p class="card-header-title has-text-white">LIST KATEGORI</p>
                        </header>

                        <!-- Isi Data -->
                        <div class="card-content">
                            <table class="table is-bordered is-hoverable is-fullwidth">
                                <thead>
                                    <tr>
                                        <th class="has-text-centered">No.</th>
                                        <th class="has-text-centered">Kategori</th>
                                        <th class="has-text-centered">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr class="has-text-centered">
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $category->category }}</td>
                                        <td>
                                            <div class="buttons is-centered">
                                                <a class="button is-small is-info" href="{{ url('edit-category/'.$category->category_id) }}" onclick="return confirmEdit(event)">Edit</a>
                                                <form action="{{ url('delete-category/'.$category->category_id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event)">
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
                text: `Do you want to edit the category?`,
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
                text: `You won't be able to revert this!\nDo you want to delete the category?`,
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
