<section class="p-4 bg-white rounded-lg shadow-sm">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div class="flex items-center justify-between" style="display: grid; grid-template-columns: 100px auto; align-items: center; gap: 10px; margin-bottom: 20px;">
            <label for="current_password" style="margin: 0; font-weight: bold; font-size: 15px;">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocomplete="current-password" required />
        </div>

        <div class="flex items-center justify-between" style="display: grid; grid-template-columns: 100px auto; align-items: center; gap: 10px; margin-bottom: 20px;">
            <label for="new_password" style="margin: 0; font-weight: bold; font-size: 15px;">{{ __('New Password') }}</label>
            <input id="new_password" name="password" type="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocomplete="new-password" required />
        </div>

        <div class="flex items-center justify-between" style="display: grid; grid-template-columns: 100px auto; align-items: center; gap: 10px; margin-bottom: 20px;">
            <label for="password_confirmation" style="margin: 0; font-weight: bold; font-size: 15px;">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocomplete="new-password" required />
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 btn btn-xs btn-primary text-white" style="background: #0D6EFD;">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</section>
