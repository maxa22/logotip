const registrationForm = document.querySelector('form');

registrationForm.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(registrationForm);
    formData.append('submit', '');
    const url = 'include/login.inc.php';
    let inputs = document.querySelectorAll('input');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if(errorArray.length < 1) {
        postData(url, formData)
        .then(data => {
            if(!data){
                window.location.href = 'calculators';
            } else {
                let errorMessage = document.querySelector('.registration-form__error');
                errorMessage.innerHTML = data['error'];
                let inputs = document.querySelectorAll('input');
                for(let input of inputs) {
                    input.style.borderColor = '#a94442'
                }
            }
        });
    }
}); 
