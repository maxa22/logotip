const form = document.querySelector('form');

form.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(form);
    formData.append('submit', '');
    const url = 'include/create_calculator.inc.php';
    let inputs = document.querySelectorAll('input[type="text"], textarea, select');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if(errorArray.length < 1) {
        postData(url, formData)
        .then(result => {
            if(!result) {
                window.location.href = 'add_question';
            } else {
                let errorMessages = document.querySelectorAll('.registration-form__error');
                for(let errorMessage of errorMessages) {
                    errorMessage.innerHTML = '';
                }
                let inputs = document.querySelectorAll('input, textarea, select');
                for(let input of inputs) {
                    input.style.borderColor = '#ced4da';
                }
                for(const [key, value] of Object.entries(result)) {
                    field =    document.querySelector(`input[name="${key}"]`) ?
                                document.querySelector(`input[name="${key}"]`)
                            : document.querySelector(`textarea[name="${key}"]`) ?
                                document.querySelector(`textarea[name="${key}"]`) 
                            : document.querySelector(`select[name="${key}"]`);
                    field.style.borderColor = '#a94442';
                    field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                }
            }
        });
    }
});
