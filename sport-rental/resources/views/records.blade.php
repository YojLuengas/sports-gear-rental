<!DOCTYPE html>
<html>
<head>
    <title>Rented Equipment Records</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Menu Icon -->
    <div class="menu-icon" onclick="toggleSidebar()">☰</div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
    <a href="/home"><i class="fas fa-home sidebar-icon"></i> Home</a>
    <a href="/records"><i class="fas fa-clipboard-list sidebar-icon"></i> Records</a>
    <a href="/logout"><i class="fas fa-sign-out-alt sidebar-icon"></i> Logout</a>
    </div>

    <div class="container">
        <h2>Rented Equipment Records</h2>

        @if($rentals->isEmpty())
            <p>No rentals found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Year Level</th>
                        <th>Equipment</th>
                        <th>Rental Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentals as $rental)
                        <tr>
                            <td>{{ $rental->student_name }}</td>
                            <td>{{ $rental->year_level }}</td>
                            <td>{{ $rental->equipment->name }}</td>
                            <td>{{ $rental->rental_date }}</td>
                            <td>
                                <form method="POST" action="/return/{{ $rental->id }}">
                                    @csrf
                                    <button type="submit" class="btn danger">Return</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

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
