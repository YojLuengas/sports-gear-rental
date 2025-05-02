<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sport Rental</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- Register Page -->
<div class="register-container">
    <h2>Create an Account</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Full Name Field -->
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" required>

        <!-- Email Field -->
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <!-- Password Field -->
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <!-- Confirm Password Field -->
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <!-- Submit Button -->
        <button type="submit">Create Account</button>
    </form>

    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</div>

</body>
</html>
