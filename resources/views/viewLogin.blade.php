<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
    <nav class="navbar is-info" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item has-text-weight-bold is-size-4">Transaction Web</a>
        </div>
    </nav>
    <section class="section full-height">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                    <form method="POST" action="{{ route('login') }}" class="box has-background-primary-light">
                        @csrf
                        <label class="label" style="font-size: 24px;">
                            <p class="has-text-centered">Login Form</p>
                        </label>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" name="email" placeholder="admin@example.com" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" name="password" placeholder="*******" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <label class="checkbox">
                                <input type="checkbox" name="remember">
                                Remember me <!-- MASIH BINGUNG -->
                            </label>
                        </div>
                        <div class="field">
                            <button type="submit" class="button is-success is-fullwidth">Login</button>
                            <br>
                            <p class="has-text-centered">Belum Punya Akun?</p>
                            <a href="{{ route('register') }}" class="button is-info is-fullwidth">Create Account</a>
                        </div>
                    </form>
                    
                    <p class="has-text-centered">
                        <a href="#">Forgot Password?</a> <!-- MASIH BELUM BERFUNGSI -->
                    </p>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</body>
</html>
