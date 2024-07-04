<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</head>

<body>
    <nav class="navbar is-info" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
            <a class="navbar-item has-text-weight-bold is-size-4" href="{{ url('home') }}">
                Transaction Web
            </a>
        </div>

        <div class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        <span>Admin</span>
                        <span class="icon is-medium">
                            <i class="fas fa-user-circle"></i>
                        </span>
                    </a>

                    <div class="navbar-dropdown">
                        <a href="{{ url('viewProfile') }}" class="navbar-item">Profile</a>
                        <a href="{{ url('/') }}" class="navbar-item">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>
