const cards = document.querySelector('.card-container');

// add option on click 
cards.addEventListener('click', e => {
    if(e.target.classList.contains('option')) {
        e.preventDefault();
        //get number of options
        let optionNumber = e.target.parentElement.querySelectorAll('.card-option__body');
        optionNumber = optionNumber.length + 1;
        //get question number
        let questionNumber = e.target.parentElement.parentElement;
        questionNumber = questionNumber.getAttribute('data-id');
        let div = document.createElement('div');
        div.classList.add('card-option');
        div.innerHTML = `
                    <h3 class="card__header btn-secondary">Option ${optionNumber}</h3>
                    <div class="card-option__body">
                        <div class="mb-xs"> 
                            <input type="text" name="${questionNumber}optionName${optionNumber}"  class="form__input" placeholder="Option">
                            <span class="registration-form__error"></span>
                        </div>
                        <div class="mb-xs">
                            <input type="number" name="${questionNumber}optionPrice${optionNumber}"  class="form__input" placeholder="Price">
                            <span class="registration-form__error"></span>
                        </div>
                        <div>
                            <label for="${questionNumber}optionImage${optionNumber}" class="file-label mb-xs">Upload Image</label>
                            <input type="file" name="${questionNumber}optionImage${optionNumber}" id="${questionNumber}optionImage${optionNumber}" class="form__input-file">
                            <img src="" alt="" class="w-100">
                            <span class="registration-form__error"></span>
                        </div>
                    </div>
            `;
        e.target.parentElement.querySelector('.card-body__option-container').appendChild(div);
    } else if (e.target.classList.contains('form__input-file')) {
      e.target.addEventListener('change', e => {
          if(e.target.files.length > 0) {
              let img = e.target.parentElement.querySelector('img');
              setImage(e.target, img);
          }
      });
    } 
});

const addQuestion = document.getElementById('question');

//add question on button click
addQuestion.addEventListener('click', e => {
    e.preventDefault();
    //get number of qustions
    let questionNumber = e.currentTarget.parentElement.querySelectorAll('.card');
    questionNumber = questionNumber.length + 1;
    let div = document.createElement('div');
    div.classList.add('card');
    div.classList.add('mb-s');
    div.setAttribute('data-id', `${questionNumber}`)
    div.innerHTML = `
            <div class="card__header btn-primary">
                <h2>Question ${questionNumber}</h2>
            </div>
            <div class="card-body">
                <div class="card-body__question mb-xs">
                    <input type="text" class="form__input" name="${questionNumber}question" placeholder="Provide Question">
                    <span class="registration-form__error"></span>
                </div>
                <div class="card-body__option-container mb-m">
                    <div class="card-option">
                        <h3 class="card__header btn-secondary">Option 1</h3>
                        <div class="card-option__body">
                            <div class="mb-xs">
                                <input type="text" name="${questionNumber}optionName1"  class="form__input" placeholder="Option">
                                <span class="registration-form__error"></span>
                            </div>
                            <div class="mb-xs">
                                <input type="number" name="${questionNumber}optionPrice1"  class="form__input" placeholder="Price">
                                <span class="registration-form__error"></span>
                            </div>
                            <div>
                                <label for="${questionNumber}optionImage1" class="file-label mb-xs">Upload Image</label>
                                <input type="file" name="${questionNumber}optionImage1" id="${questionNumber}optionImage1" class="form__input-file">
                                <img src="" alt="">
                                <span class="registration-form__error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-option">
                        <h3 class="card__header btn-secondary">Option 2</h3>
                        <div class="card-option__body" >
                            <div class="mb-xs">
                                <input type="text" name="${questionNumber}optionName2"  class="form__input" placeholder="Option">
                                <span class="registration-form__error"></span>
                            </div>
                            <div class="mb-xs">
                                <input type="number" name="${questionNumber}optionPrice2"  class="form__input" placeholder="Price">
                                <span class="registration-form__error"></span>
                            </div>
                            <div>
                            <label for="${questionNumber}optionImage2" class="file-label mb-xs">Upload Image</label>
                            <input type="file" name="${questionNumber}optionImage2" id="${questionNumber}optionImage2" class="form__input-file">
                            <img src="" alt="">
                            <span class="registration-form__error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-secondary option" >Add option</button>
            </div>
    `
    e.currentTarget.parentElement.querySelector('.card-container').appendChild(div);
});