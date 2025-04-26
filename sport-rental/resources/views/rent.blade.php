<!DOCTYPE html>
<html>
<head>
    <title>Rent - {{ $equipment->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Menu Icon -->
<div class="menu-icon" onclick="toggleSidebar()">☰</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const menuIcon = document.querySelector('.menu-icon');
        sidebar.classList.toggle('active');
        menuIcon.classList.toggle('active');
    }
</script>


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


    <div class="container">
        <h2>Rent {{ $equipment->name }}</h2>
        
        <!-- Image of the equipment -->
        <div class="card">
            <img src="{{ asset('images/' . $equipment->image) }}" alt="{{ $equipment->name }}">
        </div>

        <!-- Form to rent the equipment -->
        <form method="POST" action="/rent/{{ $equipment->id }}">
            @csrf
            <label>Student Name:</label>
            <input type="text" name="name" required>

            <label>Year Level:</label>
            <input type="text" name="year" required>

            <label>Rental Date:</label>
            <input type="date" name="date" required>

            <button type="submit">Submit</button>
        </form>

        <!-- Back to Home button -->
        <a href="/home" class="back-btn">Back to Home</a>
    </div>

    <!-- Toggle Script -->
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
