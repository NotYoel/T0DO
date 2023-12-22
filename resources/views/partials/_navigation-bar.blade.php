<nav>
    <div class="nav__container">
        <h1><a href="/">T0DO</a></h1>
        <ul class="nav__items">
            <li><a href="/">Home</a></li>
            <li><a href="/contact">Contact</a></li>
            @auth
                <li><a href="/dashboard">Dashboard</a></li>
            @endauth
        </ul>

        @auth
            <div class="nav__authed">
                <h1>Welcome, {{auth()->user()->username}}</h1>
                <form action="/logout" method="post">
                    @csrf

                    <input type="submit" value="Logout">
                </form>
            </div>
        @else
            <div class="nav__btns">
                <button><a href="/register">Register</a></button>
                <button><a href="/login">Login</a></button>
            </div>
        @endauth
    </div>
</nav>