const edits = document.querySelectorAll('.edit');



for(let edit of edits) {
    edit.addEventListener('click', e => {
        e.preventDefault();
        const container = e.currentTarget.parentElement.parentElement;
        let editButtonContainer = document.querySelectorAll('.disabling');
        hideFields(editButtonContainer);
        let inputs = container.querySelectorAll('input[type="text"], input[type="color"], input[type="number"], textarea');
        let inputFiles = container.querySelectorAll('input[type="file"]');
        let selects = container.querySelectorAll('select');
        //if selects, get their value
        let selectsValue = selects.length > 0 ? selects[0].value : '';
        enableInputFields(inputs);
        enableInputFields(selects);
        enableInputFields(inputFiles);
        let inputValueArray = getInputValues(inputs);
        let editingButtons = container.querySelectorAll('.editing');
        showFields(editingButtons);
        const cancel = container.querySelector('.cancel');
        cancel.addEventListener('click', e => {
            e.preventDefault();
            returnInitialValueToInputFields(inputs, inputValueArray);
            if(selects.length > 0) {
                selects[0].value = selectsValue;
            }
            disableInputFields(inputs);
            disableInputFields(selects);
            disableInputFields(inputFiles);
            showFields(editButtonContainer);
            hideFields(editingButtons);
            removeAddedOptionFields(container);
            removeErrorTextAndBorderColor(container);
        })
    })
}


