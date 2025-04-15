<!DOCTYPE html>
<html>
<head>
    <title>Rent - {{ $equipment->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
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
</body>
</html>
