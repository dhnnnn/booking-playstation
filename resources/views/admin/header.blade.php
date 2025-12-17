<div class="logo">
    <img src="img/Logo.png" alt="MD Gaming Logo">
</div>
<nav>
    <ul>
        <li><a href="{{url('/home')}}" class="active">Dashboard</a></li>
        <li><a href="{{url('/bookings')}}">Booking</a></li>
        <li><a href="{{url('/rooms')}}">Rooms</a></li>
        <li><a href="{{url('/addons')}}">Add ons</a></li>
    </ul>
</nav>
<div class="user-actions">
    <i class="fa-solid fa-user"></i>
    <i class="fa-solid fa-bell"></i>
    <i class="fa-solid fa-cog"></i>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
            <button type="submit" class="logout-btn">Log Out</button>
    </form>
</div>