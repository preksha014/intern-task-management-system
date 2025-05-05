<!DOCTYPE html>
<html>
<head>
    <title>Intern Login</title>
</head>
<body>
    <h1>Intern Login</h1>
    <form method="POST" action="{{ route('intern.login') }}">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <p>Not registered? <a href="{{ route('intern.register.form') }}">Register as Intern</a></p>
</body>
</html>