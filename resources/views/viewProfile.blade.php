<!-- resources/views/profile.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @include('header')
    <section class="hero">
        <div class="hero-body columns">
            @include('navigation')
            <div class="container">
                <h1 class="title">Admin Profile</h1>
                <div class="media">
                    <div class="media-left">
                        <!-- Profile Picture -->
                        <figure class="image is-256x256">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7vGGd__qXwflrcaFkYSKU45MSLLrofeKSBw&s" alt="Profile Picture" style="border-radius: 50%; width: 256px; height: 256px;">
                        </figure>
                    </div>
                    <div class="media-content">
                        <br><br><br>
                        <div class="content">
                            <p><strong>Username :</strong> {{ $admin->name }}</p>
                        </div>
                        <div class="content">
                            <p><strong>Email :</strong> {{ $admin->email }}</p>
                        </div>
                        <div class="content">
                            <p><strong>Password :</strong> ********</p>
                        </div>
                        <div class="content">
                            <p><strong>Created At :</strong> {{ $createdAt }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</body>

</html>