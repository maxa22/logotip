const registrationForm = document.querySelector('form');

registrationForm.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(registrationForm);
    formData.append('submit', '');
    const url = 'include/register.inc.php';
    let inputs = document.querySelectorAll('input');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if(errorArray.length < 1) {
        postData(url, formData)
        .then(result => {
            if(!result) {
                window.location.href = 'login';
            } else {
                let usernameError = document.querySelector('.registration-form__error.username');
                let emailError = document.querySelector('.registration-form__error.email');
                let passwordErrors = document.querySelectorAll('.registration-form__error.password');
                usernameError.innerHTML = result['username'] ?? '';
                usernameError.parentElement.querySelector('input').style.borderColor = result['username'] ? '#a94442' : '#ced4da';
                emailError.innerHTML = result['email'] ?? '';
                emailError.parentElement.querySelector('input').style.borderColor = result['email'] ? '#a94442' : '#ced4da';
                for(let passwordError of passwordErrors) {
                    passwordError.innerHTML = result['password'] ?? '';
                    passwordError.parentElement.querySelector('input').style.borderColor = result['password'] ? '#a94442' : '#ced4da';
                }
            }
        });
    }
});

