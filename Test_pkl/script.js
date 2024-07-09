const forms = document.querySelectorAll('form');

forms.forEach(form => {
    form.addEventListener('submit', (event) => {
        if (!validateForm(form)) {
            event.preventDefault(); // Prevent form submission if not valid
        }
    });
});

function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input');

    inputs.forEach(input => {
        if (!input.checkValidity()) {
            isValid = false;
            showError(input, input.validationMessage);
        } else {
            hideError(input);
        }
    });

    return isValid;
}

function showError(input, message) {
    const errorSpan = input.parentNode.querySelector('.error');
    if (!errorSpan) {
        const newErrorSpan = document.createElement('span');
        newErrorSpan.classList.add('error');
        newErrorSpan.textContent = message;
        input.parentNode.appendChild(newErrorSpan);
    }
}

function hideError(input) {
    const errorSpan = input.parentNode.querySelector('.error');
    if (errorSpan) {
        errorSpan.remove();
    }
}
