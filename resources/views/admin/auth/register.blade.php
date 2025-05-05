<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>
    <h1>Admin Registration</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password')
                <span style="color: red;">{{ $message }}</span>
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
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label>Position</label>
            <input type="text" name="position" value="{{ old('position') }}" required>
            @error('position')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="{{ route('admin.login.form') }}">Login</a></p>
</body>
</html>