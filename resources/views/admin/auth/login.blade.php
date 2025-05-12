<x-guest-layout>
    <div class="mt-4 text-center">
        <h1 class="text-3xl font-bold text-gray-900">Admin Login</h1>
        <p class="mt-2 text-sm text-gray-600">Welcome back! Please enter your credentials.</p>
    </div>

    @if (session('error'))
        <div class="mb-4 text-sm text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <form id="login-form" method="POST" action="{{ route('admin.login') }}" class="space-y-4 bg-white p-6 max-w-md mx-auto">
        @csrf

        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
            <div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition duration-150 ease-in-out"
                    autocomplete="email" placeholder="your.email@example.com">
            </div>
            @error('email')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <div>
                <input id="password" type="password" name="password" required
                    class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition duration-150 ease-in-out"
                    autocomplete="current-password" placeholder="••••••••">
            </div>
        </div>

        <div class="pt-1">
            <button type="submit"
                class="flex w-full justify-center rounded-lg border border-transparent bg-indigo-600 py-2 px-4 text-sm font-semibold text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform transition duration-150 ease-in-out hover:scale-[1.02]">
                Sign In
            </button>
        </div>

        <div class="text-xs text-center text-gray-600 mt-3">
            New to the platform?
            <a href="{{ route('admin.register.form') }}"
                class="font-semibold text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                Create an Admin Account
            </a>
        </div>
    </form>
</x-guest-layout>