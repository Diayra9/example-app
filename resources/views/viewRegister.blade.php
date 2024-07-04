<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
                    <form method="POST" action="{{ route('register') }}" class="box has-background-primary-light">
                        @csrf
                        <label class="label" style="font-size: 24px;">
                            <p class="has-text-centered">Registration Form</p>
                        </label>
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="name" placeholder="Your Name" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                        </div>
                        @error('name')
                        <small>{{ $message }}</small>
                        @enderror
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" name="email" placeholder="admin@example.com" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                        @error('email')
                        <small>{{ $message }}</small>
                        @enderror
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" name="password" placeholder="*******" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                        <small>{{ $message }}</small>
                        @enderror
                        <div class="field">
                            <label class="label">Confirm Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" name="password_confirmation" placeholder="*******" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <button type="submit" class="button is-success is-fullwidth">Create Account</button>
                            <br>
                            <p class="has-text-centered">Sudah Punya Akun?</p>
                            <a href="{{ url('/') }}" class="button is-info is-fullwidth">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</body>

</html>