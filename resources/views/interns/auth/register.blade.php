<x-guest-layout>
    <div class="mt-4 text-center">
        <h1 class="text-3xl font-bold text-gray-900">Intern Registration</h1>
        <p class="mt-2 text-sm text-gray-600">Create your account to get started</p>
    </div>

    @if (session('success'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form id="register-form" method="POST" action="{{ route('intern.register') }}" class="space-y-4 bg-white p-6 max-w-md mx-auto">
        @csrf

        <div class="space-y-1">
            <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
            <div>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition duration-150 ease-in-out"
                    placeholder="John Doe">
            </div>
            @error('name')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
            <div>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition duration-150 ease-in-out"
                    placeholder="your.email@example.com">
            </div>
            @error('email')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <div>
                <input id="password" type="password" name="password"
                    class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition duration-150 ease-in-out"
                    placeholder="••••••••">
            </div>
            @error('password')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm
                Password</label>
            <div>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition duration-150 ease-in-out"
                    placeholder="••••••••">
            </div>
        </div>

        <div class="space-y-1">
            <label for="department" class="block text-sm font-semibold text-gray-700">Department</label>
            <div>
                <input id="department" type="text" name="department" value="{{ old('department') }}"
                    class="block w-full px-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition duration-150 ease-in-out"
                    placeholder="e.g. Engineering">
            </div>
            @error('department')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-1">
            <button type="submit"
                class="flex w-full justify-center rounded-lg border border-transparent bg-indigo-600 py-2 px-4 text-sm font-semibold text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform transition duration-150 ease-in-out hover:scale-[1.02]">
                Create Account
            </button>
        </div>

        <div class="text-xs text-center text-gray-600 mt-3">
            Already have an account?
            <a href="{{ route('intern.login.form') }}"
                class="font-semibold text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                Sign in instead
            </a>
        </div>
    </form>
</x-guest-layout>