<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a href="{{route('welcome')}}" class="navbar-brand text-primary">LebWebDev</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <i class="fas fa-bars text-dark"></i>
    </button>
    <nav class="collapse navbar-collapse" id="main-nav">
        <ul class="navbar-nav">
            @guest
            @else
                @if(Auth::user()->navigationRoles(['admin']))
                <li class="nav-item">
                    <a href="{{route('admin.home')}}" class="nav-link {{Route::current()->getPrefix() === '/admin' ? 'text-success' : 'text-dark'}}">Admin</a>
                </li>
                @endif
                @if(Auth::user()->navigationRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']))
                <li class="nav-item">
                    <a href="" class="nav-link text-dark">Human Resources</a>
                </li>
                @endif
            @endguest
        </ul>
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a href="{{route('login')}}" class="nav-link text-dark">Log In</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link text-dark">Sign Up</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
                <form action="{{route('logout')}}" method="POST" id="logout-form" class="display-none">@csrf</form>
            </li>
            <a href="{{route('home')}}" class="navbar-brand text-success ml-md-4">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
            @endguest
        </ul>
    </nav>
</nav>