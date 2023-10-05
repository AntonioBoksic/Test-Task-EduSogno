
// funzione per mostrare la password nei form
document.addEventListener('DOMContentLoaded', function () {
    const togglePasswordButtons = document.querySelectorAll('.togglePassword');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Assume che l'input della password sia il "fratello" precedente del pulsante di alternanza
            const passwordInput = button.previousElementSibling;
            if (passwordInput && passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else if (passwordInput) {
                passwordInput.type = 'password';
            }
        });
    });
});

