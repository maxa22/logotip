const options = document.querySelectorAll('.card-body__option-container');

for(let option of options) {
    option.addEventListener('click', e => {
        if(e.target.classList.contains('form__input-file')) {
            const inputFile = e.target;
            inputFile.addEventListener('change', () => {
                let img = inputFile.parentElement.querySelector('img');
                setImage(inputFile, img);
            })
        }
    })
}