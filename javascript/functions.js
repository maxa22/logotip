async function postData(url, data) {
    const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        body: data // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript object
}

async function getData(url) {
    const response = await fetch(url, {
        method: 'Get', // *GET, POST, PUT, DELETE, etc.
    });
    return response.json(); // parses JSON response into native JavaScript object
}

function enableInputFields(inputFieldsArray) {
    for(let input of inputFieldsArray) {
        input.removeAttribute('disabled');
    }
}

function getInputValues(inputFieldsArray) {
    let inputValuesArray = [];
    for(let input of inputFieldsArray) {
        const value = input.getAttribute('value');
        inputValuesArray.push(value);
    }
    return inputValuesArray;
}

function disableInputFields(inputFieldsArray) {
    for(let input of inputFieldsArray) {
        input.setAttribute('disabled', 'true');
    }
}

function returnInitialValueToInputFields(inputFieldsArray, inputValueArray) {
    for(let i=0; i < inputFieldsArray.length; i++) {
        inputFieldsArray[i].value = inputValueArray[i];
    }
}

function hideFields(fields) {
    for(let field of fields) {
        field.style.display = 'none';
    }
}

function showFields(fields) {
    for(let field of fields) {
        field.style.display = 'block';
    }
}

function removeAddedOptionFields(container) {
    let addedFields = container.querySelectorAll('.new');
    for(let addedField of addedFields) {
        addedField.remove();
    }
}

function setImage(inputField, img) {
    img.src = URL.createObjectURL(inputField.files[0]);
    img.onload = function() {
        URL.revokeObjectURL(img.src);
    }
}


function showImagePreviewOnChange(fileUploads) {
    for(let fileUpload of fileUploads) {
        fileUpload.addEventListener('change', e => {
            const container = e.target.parentElement;
            let img = container.querySelector('img');
            setImage(fileUpload, img);
        });
    }
}

function removeErrorTextAndBorderColor(container) {
    let errorMessages = container.querySelectorAll('.registration-form__error');
    for(let errorMessage of errorMessages) {
        errorMessage.innerHTML = '';
    }
    let inputs = container.querySelectorAll('input, textarea, select');
    for (let input of inputs) {
        input.style.borderColor = '#ced4da'
    }
}

function isEmpty(inputs, errorArray) {
    for(let input of inputs) {
        if(input.value == '') {
            input.style.borderColor = '#a94442';
            input.parentElement.querySelector('.registration-form__error').innerHTML = 'Field can\'t be empty';
            errorArray.push('error');
        } else {
            input.style.borderColor = '#ced4da';
            input.parentElement.querySelector('.registration-form__error').innerHTML = '';
        }
    }
}