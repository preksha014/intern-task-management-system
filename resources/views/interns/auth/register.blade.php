<!DOCTYPE html>
<html>
<head>
    <title>Intern Register</title>
</head>
<body>
    <h1>Intern Registration</h1>
    <form method="POST" action="{{ route('intern.register') }}">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
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
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div>
            <label>Department</label>
            <input type="text" name="department" value="{{ old('department') }}" required>
            @error('department')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="{{ route('intern.login.form') }}">Login</a></p>
</body>
</html>