const forms = document.querySelectorAll('.question-form');

for(let form of forms) {
    form.addEventListener('submit', e => {
        e.preventDefault();
        let formData = new FormData(form);
        formData.append('submit', '');
        const url = '../include/update_question.inc.php';
        let errorArray = [];
        let inputs = form.querySelectorAll('input[type="text"], input[type="number"]');
        isEmpty(inputs, errorArray);
        if(errorArray.length < 1) {
            postData(url, formData)
            .then(result => {
                if(!result) {
                    location.reload();
                } else {
                    let errorMessages = document.querySelectorAll('.registration-form__error');
                    for(let errorMessage of errorMessages) {
                        errorMessage.innerHTML = '';
                    }
                    let inputs = document.querySelectorAll('input, textarea');
                    for(let input of inputs) {
                        input.style.borderColor = '#ced4da';
                    }
                    for(const [key, value] of Object.entries(result)) {
                        let field = document.querySelector(`input[name="${key}"]`) ?
                                    document.querySelector(`input[name="${key}"]`)
                                : document.querySelector(`textarea[name="${key}"]`);
                        field.style.borderColor = '#a94442';
                        field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                    }
                }
            });
        }
    });
}

const calculatorForm = document.getElementById('calculator-form');

calculatorForm.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(calculatorForm);
    formData.append('submit', '');
    const url = '../include/update_calculator.inc.php';
    let errorArray = [];
    let inputs = calculatorForm.querySelectorAll('input[type="text"], textarea, select');
    isEmpty(inputs, errorArray);
    if(errorArray.length < 1) {
        postData(url, formData)
        .then(result => {
            if(!result) {
                location.reload();
            } else {
                let errorMessages = document.querySelectorAll('.registration-form__error');
                for(let errorMessage of errorMessages) {
                    errorMessage.innerHTML = '';
                }
                let inputs = document.querySelectorAll('input, textarea');
                for(let input of inputs) {
                    input.style.borderColor = '#ced4da';
                }
                for(const [key, value] of Object.entries(result)) {
                    let field = document.querySelector(`input[name="${key}"]`) ?
                                document.querySelector(`input[name="${key}"]`)
                            : document.querySelector(`textarea[name="${key}"]`);
                    field.style.borderColor = '#a94442';
                    field.parentElement.querySelector('.registration-form__error').innerHTML = value;
                }
            }
        });
    }
});