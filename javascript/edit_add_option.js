const addOptionsButton = document.querySelectorAll('.add-option');

for(let addOption of addOptionsButton) {
    addOption.addEventListener('click', e => {
        e.preventDefault();
        const container = e.currentTarget.parentElement;
        const optionNumber = container.querySelectorAll('.card-option').length + 1;
        let newOption = document.createElement('div');
        newOption.classList.add('card-option');
        newOption.classList.add('new');
        newOption.innerHTML = `
            <div class="card__header card__header-border">
                <h3>Option ${optionNumber}</h3>
            </div>
            <div class="card-option__body">
                <p class="error-message mb-xs"></p>
                <div class="mb-xs">
                    <label for="${optionNumber}new-optionName">Name</label>
                    <input type="text" class="form__input" name="${optionNumber}new-optionName" id="${optionNumber}new-optionName">
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xs">
                    <label for="${optionNumber}new-optionPrice">Price</label>
                    <input type="number" class="form__input" name="${optionNumber}new-optionPrice" id="${optionNumber}new-optionPrice">
                    <span class="registration-form__error"></span>    
                </div>
                <div>
                    <label for="${optionNumber}new-optionImage" class="file-label mb-xs">Upload Image</label>
                    <input type="file" class="form__input-file" name="${optionNumber}new-optionImage" id="${optionNumber}new-optionImage">
                    <img src="" class="w-100">
                    <span class="registration-form__error"></span>    
                </div>
            </div>
        `;
        container.querySelector('.card-body__option-container').appendChild(newOption);
    })
}

