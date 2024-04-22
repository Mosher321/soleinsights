<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('SimpleStarRating.css')}}">
    <script src="{{asset('SimpleStarRating.js')}}"></script>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-sm" style="background-color: #b5c4d0;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('welcome')}}">
            <img src="{{asset('images/shoe-logo.png')}}" alt="Avatar Logo" style="width:100px;" class="rounded-pill">
        </a>
        <a class="navbar-brand" style="text-decoration: none; color: black; font-weight: bold; font-size: 30px" href="{{route('welcome')}}">SOLE INSIGHTS</a>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
                </li>
            </ul>
            <div class="d-flex">
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown">
                                    Welcome {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                this.closest('form').submit();">Logout</a></li>
                                    </form>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn" style="background-color: black"><span style="color: white">Login</span></a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn" style="background-color: black"><span style="color: white">Register</span></a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="container" style="background: #f7f7f7">
    @yield('main-section')
</div>

@stack('scripts')

<script>
    var ratings = document.getElementsByClassName('rating');

    for (var i = 0; i < ratings.length; i++) {
        var r = new SimpleStarRating(ratings[i]);

        ratings[i].addEventListener('rate', function(e) {
            console.log('Rating: ' + e.detail);
        });
    }
</script>

</body>
</html>
