<!DOCTYPE html>
<html>
<head>
    <title>Rental History - Sport Rental</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

<!-- Sidebar -->
<div class="menu-icon" onclick="toggleSidebar()">☰</div>
<div class="sidebar" id="sidebar">
    <a href="/home"><i class="fas fa-home sidebar-icon"></i> Home</a>
    <a href="/records"><i class="fas fa-clipboard-list sidebar-icon"></i> Records</a>
    <a href="/history"><i class="fas fa-history sidebar-icon"></i> History</a>
    <a href="/logout"><i class="fas fa-sign-out-alt sidebar-icon"></i> Logout</a>
    <div class="sidebar-logo">
        <img src="/images/logo.png" alt="Logo">
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const menuIcon = document.querySelector('.menu-icon');
    sidebar.classList.toggle('active');
    menuIcon.classList.toggle('active');
}
</script>

<!-- Main Content -->
<div class="container">
    <h2>Rental History</h2>

    <!-- Filter Form -->
    <form method="GET" action="/history" class="search-form">
        <select name="equipment_name">
            <option value="">All Equipment</option>
            @foreach(App\Models\Equipment::all() as $equip)
                <option value="{{ $equip->name }}" {{ request('equipment_name') == $equip->name ? 'selected' : '' }}>
                    {{ $equip->name }}
                </option>
            @endforeach
        </select>

        <select name="year_level">
            <option value="">All Year Levels</option>
            @for ($i = 1; $i <= 4; $i++)
                <option value="{{ $i }}" {{ request('year_level') == $i ? 'selected' : '' }}>
                    Year {{ $i }}
                </option>
            @endfor
        </select>

        <input type="date" name="rental_date" value="{{ request('rental_date') }}">
        <!-- Search Student Name Input -->
        <input type="text" id="searchInput" placeholder="Search student name..." style="padding: 10px; width: 250px; border-radius: 8px; border: 1px solid #ccc;">
        <button type="submit" class="btn">Filter</button>
    </form>

    

    <!-- Rental Table -->
    <div class="history-table">
        <table>
            <thead>
                <tr>
                    <th>Equipment</th>
                    <th>Student Name</th>
                    <th>Year Level</th>
                    <th>Rental Date</th>
                </tr>
            </thead>
            <tbody id="rentalTableBody">
                @forelse ($rentals as $rental)
                    <tr>
                        <td>{{ $rental->equipment->name }}</td>
                        <td class="student-name">{{ $rental->student_name }}</td>
                        <td>{{ $rental->year_level }}</td>
                        <td>{{ $rental->rental_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No rentals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Live Search Script -->
<script>
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('#rentalTableBody tr');

    searchInput.addEventListener('keyup', function () {
        const query = this.value.toLowerCase();
        rows.forEach(row => {
            const studentName = row.querySelector('.student-name')?.textContent.toLowerCase();
            row.style.display = studentName.includes(query) ? '' : 'none';
        });
    });
</script>

</body>
</html>
