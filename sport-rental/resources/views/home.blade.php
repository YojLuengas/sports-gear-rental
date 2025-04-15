<!DOCTYPE html>
<html>
<head>
    <title>Home - Sport Rental</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h2>Available Equipment</h2>

        @foreach ($equipment as $item)
            <div class="card">
                <h3>{{ $item->name }}</h3>
                <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}">
                <p class="availability">
                    {{ $item->rented_quantity ?? 0 }}/{{ $item->total_quantity ?? 3 }} Rented
                </p>
                <a href="/rent/{{ $item->id }}" class="btn">Rent</a>
            </div>
        @endforeach

        <a href="/logout" class="logout-btn">Logout</a>
    </div>
</body>
</html>
