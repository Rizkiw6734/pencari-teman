<section class="p-4 bg-white rounded-lg shadow-sm">
    <header>
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">Profile Information</h6>
            </div>
            <div class="col-md-4 text-end">
                <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                </a>
            </div>
        </div>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <!-- Input for Name -->
        <div class="form-group" style="display: grid; grid-template-columns: 100px auto; align-items: center; gap: 10px;">
            <label for="name" style="margin: 0; font-weight: bold; font-size: 20px;">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input for Email -->
        <div class="form-group" style="display: grid; grid-template-columns: 100px auto; align-items: center; gap: 10px;">
            <label for="email" style="margin: 0; font-weight: bold; font-size: 20px;">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Verification Notification -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mb-4">
                <p class="text-sm text-gray-600">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="text-sm text-indigo-600 hover:underline">
                        {{ __('Click here to resend the verification email.') }}
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 btn btn-xs btn-primary text-white" style="background: #0D6EFD;">
                {{ __('Save') }}
            </button>
        </div>

        <!-- Success Message -->
        @if (session('status') === 'profile-updated')
            <p class="mt-2 text-sm text-green-600">
                {{ __('Profile information updated successfully.') }}
            </p>
        @endif
    </form>
</section>
