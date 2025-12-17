document.addEventListener('DOMContentLoaded', function() {
    var forms = document.querySelectorAll('.kit-signup-form');

    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var button = form.querySelector('button[type="submit"]');
            var messageDiv = form.querySelector('.kit-signup-message');
            var nameInput = form.querySelector('input[name="kit_signup_name"]');
            var emailInput = form.querySelector('input[name="kit_signup_email"]');
            var nonceInput = form.querySelector('input[name="kit_signup_nonce"]');
            var honeypotInput = form.querySelector('input[name="kit_signup_website"]');

            messageDiv.textContent = '';
            messageDiv.className = 'kit-signup-message';

            var email = emailInput.value.trim();
            var firstName = nameInput.value.trim();

            if (!firstName) {
                messageDiv.textContent = 'Please enter your first name';
                messageDiv.classList.add('error');
                return;
            }

            if (!email || !isValidEmail(email)) {
                messageDiv.textContent = 'Please enter a valid email address';
                messageDiv.classList.add('error');
                return;
            }

            button.disabled = true;
            var originalText = button.textContent;
            button.textContent = 'Subscribing...';

            var formData = new FormData();
            formData.append('action', 'kit_signup_submit');
            formData.append('nonce', nonceInput.value);
            formData.append('email', email);
            formData.append('first_name', firstName);
            formData.append('website', honeypotInput.value);

            fetch(kitSignupData.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    messageDiv.textContent = data.data.message;
                    messageDiv.classList.add('success');
                    form.reset();
                } else {
                    messageDiv.textContent = data.data.message || kitSignupData.messageError;
                    messageDiv.classList.add('error');
                }
            })
            .catch(function() {
                messageDiv.textContent = kitSignupData.messageError;
                messageDiv.classList.add('error');
            })
            .finally(function() {
                button.disabled = false;
                button.textContent = originalText;
            });
        });
    });

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});
