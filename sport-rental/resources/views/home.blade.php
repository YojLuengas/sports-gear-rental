<!DOCTYPE html>
<html>
<head>
    <title>Home - Sport Rental</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<div class="header">
<span>Holy Cross Davao College</span>
</div>



    <!-- Menu Icon -->
    <div class="menu-icon" onclick="toggleSidebar()">☰</div>

   <!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <a href="/home"><i class="fas fa-home sidebar-icon"></i> Home</a>
    <a href="/records"><i class="fas fa-clipboard-list sidebar-icon"></i> Records</a>
    <a href="/history"><i class="fas fa-history sidebar-icon"></i> History</a>
    <a href="/logout"><i class="fas fa-sign-out-alt sidebar-icon"></i> Logout</a>

    <!-- Logo at the bottom -->
    <div class="sidebar-logo">
        <img src="/images/logo.png" alt="Logo">
    </div>
</div>


    <!-- Main Container -->
    <div class="card-container">
    @foreach ($equipment as $item)
        <div class="card">
            <h3>{{ $item->name }}</h3>
            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}">
            <p class="availability">
                {{ $item->rented_quantity ?? 0 }}/{{ $item->total_quantity ?? 3 }} Rented
            </p>
            @if (($item->rented_quantity ?? 0) >= ($item->total_quantity ?? 3))
                <p class="unavailable">No more available equipment</p>
            @else
                <a href="/rent/{{ $item->id }}" class="btn">Rent</a>
            @endif
        </div>
    @endforeach
</div>


    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const menuIcon = document.querySelector('.menu-icon');
            sidebar.classList.toggle('active');
            menuIcon.classList.toggle('active');
        }
    </script>

</body>
</html>
