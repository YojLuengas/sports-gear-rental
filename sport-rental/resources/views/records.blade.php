<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Records - Sport Rental</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
<body>

<!-- Sidebar -->
<div class="menu-icon" onclick="toggleSidebar()">☰</div>
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
    <h2>Current Rental Records</h2>

    <div class="records-table">
        <table>
            <thead>
                <tr>
                    <th>Equipment</th>
                    <th>Student Name</th>
                    <th>Year Level</th>
                    <th>Rental Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rentals as $rental)
                    <tr>
                        <td>{{ $rental->equipment->name }}</td>
                        <td>{{ $rental->student_name }}</td>
                        <td>{{ $rental->year_level }}</td>
                        <td>{{ $rental->rental_date }}</td>
                        <td>
                            <!-- Return Button -->
                            <form action="/return/{{ $rental->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST') <!-- 👈 Important: match your route -->
                                <button type="submit" class="btn return-btn">Return</button>
                            </form>

                            <!-- Update Button -->
                            <button class="btn update-btn" onclick="toggleUpdateForm('{{ $rental->id }}')">Update</button>
                        </td>
                    </tr>

                    <!-- Hidden Update Form -->
                    <tr id="update-form-{{ $rental->id }}" class="update-form-row" style="display:none;">
                        <td colspan="5">
                            <form action="/update/{{ $rental->id }}" method="POST" class="update-form">
                                @csrf
                                @method('PUT')
                                <input type="text" name="student_name" value="{{ $rental->student_name }}" required placeholder="Student Name">
                                <input type="text" name="year_level" value="{{ $rental->year_level }}" required placeholder="Year Level">
                                <input type="date" name="rental_date" value="{{ $rental->rental_date }}" required placeholder="Rental Date">
                                <div class="form-buttons">
                                    <button type="submit" class="btn save-btn">Save</button>
                                    <button type="button" class="btn cancel-btn" onclick="toggleUpdateForm('{{ $rental->id }}')">Cancel</button>
                                </div>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5">No rental records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleUpdateForm(id) {
    var formRow = document.getElementById('update-form-' + id);
    if (formRow.style.display === 'none' || formRow.style.display === '') {
        formRow.style.display = 'table-row';  // Ensure it is shown as a table row
    } else {
        formRow.style.display = 'none'; // Hide the form again
    }
}
</script>

</body>
</html>
