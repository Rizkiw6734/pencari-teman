import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('togglePassword');

    eyeIcon.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
});
