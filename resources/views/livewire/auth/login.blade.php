<div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow p-8">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <x-app-logo-icon class="h-12 w-12 text-blue-600 dark:text-blue-400" />
    </div>

    <!-- Title -->
    <h2 class="text-center text-2xl font-bold text-gray-900 dark:text-gray-100">
        Log in to your account
    </h2>
    <p class="mt-1 text-center text-sm text-gray-600 dark:text-gray-400">
        Enter your Username and password below
    </p>

    <!-- Form -->
    <form wire:submit.prevent="login" class="mt-6 space-y-5">
        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Username
            </label>
            <input wire:model="username" id="username" type="text" required autofocus
                placeholder="Pakeshh Edannnn Example"
                class="mt-2 block w-full rounded-md border border-gray-300 bg-white/5 px-4 py-3 
                       text-gray-900 placeholder:text-gray-400 placeholder:text-center shadow-sm
                       focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50
                       dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100 sm:text-base">
            @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Password
            </label>
            <input wire:model="password" id="password" type="password" required
                placeholder="********"
                class="mt-2 block w-full rounded-md border border-gray-300 bg-white/5 px-4 py-3 
                       text-gray-900 placeholder:text-gray-400 placeholder:text-center shadow-sm
                       focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50
                       dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100 sm:text-base">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember" wire:model="remember" type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 
                       dark:bg-gray-700 dark:border-gray-600">
            <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                Remember me
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full rounded-md bg-blue-600 px-4 py-2 text-white font-semibold shadow 
                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Log in
        </button>
    </form>
</div>
