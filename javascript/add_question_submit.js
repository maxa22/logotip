const form = document.querySelector('form');


form.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(form);
    formData.append('submit', '');
    const url = 'include/add_question.inc.php';
    let inputs = form.querySelectorAll('input[type="text"], input[type="number"]');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if(errorArray.length < 1) {
        postData(url, formData)
        .then(result => {
            if(!result) {
                const referrer = document.referrer;
                if(referrer.includes('edit')) {
                    window.location.href = referrer;
                } else {
                    window.location.href = 'calculators';
                }
            } else {
                // add number to error array and add div to every card to display error message
                // scroll to error message
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