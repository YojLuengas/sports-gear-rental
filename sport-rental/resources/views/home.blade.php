<!DOCTYPE html>
<html>
<head>
    <title>Home - Sport Rental</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<div class="header">
    <div class="header-content">
        <div class="header-text">
            <span class="header-title">Holy Cross of Davao College</span>
            <span class="header-subtitle">Sport Equipment Rental System</span>
        </div>
        <img src="/images/logo2.png" alt="HCDC Logo" class="header-logo">
    </div>
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

    @php
        $rented = $item->rented_quantity ?? 0;
        $total = $item->total_quantity ?? 3;
        $available = $total - $rented;
    @endphp

    <p class="availability">Available: {{ $available }}</p>
    <p class="availability">Rented: {{ $rented }}</p>

    @if ($available <= 0)
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
