<section class="p-4 bg-red-50 rounded-lg shadow-sm">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="px-4 py-2 btn btn-xs btn-danger mb-4" onclick="confirmDeleteAccount()">
        {{ __('Delete Account') }}
    </button>

    <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}" style="display: none;">
        @csrf
        @method('delete')
        <input type="hidden" name="password" id="password">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function confirmDeleteAccount() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Please enter your password to confirm account deletion.",
                input: 'password',
                inputPlaceholder: 'Enter your password',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Confirm Delete',
                cancelButtonText: 'Cancel',
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage('Password required');
                    }
                    return password;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('password').value = result.value;
                    document.getElementById('delete-account-form').submit();
                }
            });
        }
    </script>
</section>
