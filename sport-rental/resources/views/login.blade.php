<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sport Rental</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">
    
    <!-- Loading Overlay -->
    <div id="loading-overlay">
    <div class="loader">
        <!-- Basketball -->
        <div class="icon basketball">
            🏀
        </div>

        <!-- Volleyball -->
        <div class="icon volleyball">
            🏐
        </div>

        <!-- Soccer Ball -->
        <div class="icon soccer">
            ⚽
        </div>
    </div>
    </div>
    <div class="login-container">
        <h2>Login</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <!-- Email Field -->
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required placeholder="Enter your email">

            <!-- Password Field -->
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required placeholder="Enter your password">

            <!-- Login Button -->
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="{{ route('register') }}">Create an Account</a></p>


    </div>
    
    <script>
    document.querySelector("form").addEventListener("submit", function() {
    document.getElementById("loading-overlay").style.display = "flex";
    });
    </script>


</body>
</html>
