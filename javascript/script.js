if(window.location.href.indexOf('calculator_render') != -1)  {
  hideSidebar();
  calculator_render();
} else if(window.location.href.indexOf('add_question') != -1) {
  add_question();
} else if(window.location.href.indexOf('calculators') != -1) {
  calculators();
} else if(window.location.href.indexOf('create_calculator') != -1) {
  create_calculator();
} else if(window.location.href.indexOf('edit') != -1) {
  edit();
} else if(window.location.href.indexOf('estimate') != -1) {
  hideSidebar();
  estimate();
} else if(window.location.href.indexOf('login') != -1) {
  login();
} else if(window.location.href.indexOf('register') != -1) {
  register();
} else if(window.location.href.indexOf('archive') != -1) {
  //
} else if(window.location.href.indexOf('examples') != -1) {
  //
} else if(window.location.href.indexOf('calculator_users') != -1) {
  calculator_users();
} else {
  hideSidebar();
}


function calculator_render() {
  if (window.location !== window.parent.location) {
    let navs = document.querySelectorAll('nav');
    for (let nav of navs) {
      nav.style.display = 'none';
    }
    document.querySelector('main').style.margin = 'auto';
  }

  // displaying new question from calculator and scrolling to it
  const divs = document.querySelectorAll('.input-wrapper');
  const inputs = document.querySelectorAll('input[type="radio"]');
  const startBtn = document.querySelector('.intro__button');
  const intro = document.querySelector('.wrapper');
  let count = 0;

  startBtn.addEventListener('click', e => {
    e.preventDefault();
    intro.style.display = "none";
    showNextQuestion();
  })

  for (let input of inputs) {
    input.addEventListener('click', () => {
      showNextQuestion();
    })
  }

  function showNextQuestion() {
    if (count < divs.length) {
      divs[count].style.display = 'block';
      divs[count].scrollIntoView();
      count++;
    }
  }
}

function add_question() {
  const cards = document.querySelector('.card-container');

  // add option on click 
  cards.addEventListener('click', e => {

    if (e.target.classList.contains('option')) {
      e.preventDefault();
      //get number of options
      let optionNumber = e.target.parentElement.querySelectorAll('.card-option__body');
      optionNumber = optionNumber.length + 1;
      //get question number
      let questionNumber = e.target.parentElement.parentElement;
      questionNumber = questionNumber.getAttribute('data-id');
      let div = document.createElement('div');
      div.classList.add('card-option');
      div.classList.add('card');
      div.classList.add('card-body');
      div.classList.add('w-25-gap-m');
      div.classList.add('l-w-50-gap-m');
      div.classList.add('m-w-100');
      div.innerHTML = `
                    <h3 class="card__header mb-s w-100 text-center">Option ${optionNumber}</h3>
                    <div class="card-option__body">
                        <div class="mb-xm"> 
                            <input type="text" name="${questionNumber}optionName${optionNumber}"  class="form__input" placeholder="Option">
                            <span class="registration-form__error"></span>
                        </div>
                        <div class="mb-xm">
                            <input type="number" name="${questionNumber}optionPrice${optionNumber}"  class="form__input" placeholder="Price">
                            <span class="registration-form__error"></span>
                        </div>
                        <div>
                            <input type="file" name="${questionNumber}optionImage${optionNumber}" id="${questionNumber}optionImage${optionNumber}" class="form__input-file">
                            <label for="${questionNumber}optionImage${optionNumber}" class="file-label mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                            <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
                            <img src="" alt="" class="w-100">
                            <span class="registration-form__error"></span>
                        </div>
                    </div>
            `;
      e.target.parentElement.querySelector('.card-body__option-container').appendChild(div);
    } else if (e.target.classList.contains('form__input-file')) {
      e.target.addEventListener('change', e => {
        showImagePreview(e, e.target);
      });
    } else if (e.target.classList.contains('remove-image')) {
      removeImageToggle(e.target, e.target);
    }
  });

  const addQuestion = document.getElementById('question');

  //add question on button click
  addQuestion.addEventListener('click', e => {
    e.preventDefault();
    //get number of qustions
    let questionNumber = e.currentTarget.parentElement.querySelectorAll('.number-of-questions');
    questionNumber = questionNumber.length + 1;
    let div = document.createElement('div');
    div.classList.add('card');
    div.classList.add('number-of-questions');
    div.classList.add('mb-s');
    div.setAttribute('data-id', `${questionNumber}`)
    div.innerHTML = `
            <div class="card__header text-center">
                <h2>Question ${questionNumber}</h2>
            </div>
            <div class="card-body">
                <div class="card-body__question mb-xm">
                    <input type="text" class="form__input" name="${questionNumber}question" placeholder="Provide Question">
                    <span class="registration-form__error"></span>
                </div>
                <div class="card-body__option-container mb-m d-flex gap-m m-flex-column wrap">
                    <div class="card-option card card-body w-25-gap-m l-w-50-gap-m m-w-100">
                        <h3 class="card__header mb-s w-100 text-center">Option 1</h3>
                        <div class="card-option__body">
                            <div class="mb-xm">
                                <input type="text" name="${questionNumber}optionName1"  class="form__input" placeholder="Option">
                                <span class="registration-form__error"></span>
                            </div>
                            <div class="mb-xm">
                                <input type="number" name="${questionNumber}optionPrice1"  class="form__input" placeholder="Price">
                                <span class="registration-form__error"></span>
                            </div>
                            <div>
                                <input type="file" name="${questionNumber}optionImage1" id="${questionNumber}optionImage1" class="form__input-file">
                                <label for="${questionNumber}optionImage1" class="file-label mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                                <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
                                <img src="" alt="" class="w-100">
                                <span class="registration-form__error"></span>
                            </div>
                        </div>
                    </div>
                    <div class=" card-option card card-body w-25-gap-m l-w-50-gap-m m-w-100">
                        <h3 class="card__header mb-s w-100 text-center"">Option 2</h3>
                        <div class="card-option__body" >
                            <div class="mb-xm">
                                <input type="text" name="${questionNumber}optionName2"  class="form__input" placeholder="Option">
                                <span class="registration-form__error"></span>
                            </div>
                            <div class="mb-xm">
                                <input type="number" name="${questionNumber}optionPrice2"  class="form__input" placeholder="Price">
                                <span class="registration-form__error"></span>
                            </div>
                            <div>
                            <input type="file" name="${questionNumber}optionImage2" id="${questionNumber}optionImage2" class="form__input-file">
                            <label for="${questionNumber}optionImage2" class="file-label mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                            <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
                            <img src="" alt="" class="w-100">
                            <span class="registration-form__error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary option btn-large" >Add option <i class="fas fa-plus hide-icon"></i></button>
            </div>
    `
    e.currentTarget.parentElement.querySelector('.card-container').appendChild(div);
  });

  const form = document.querySelector('form');


  form.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(form);
    formData.append('submit', '');
    const url = 'include/add_question.inc.php';
    let inputs = form.querySelectorAll('input[type="text"], input[type="number"]');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if (errorArray.length < 1) {
      postData(url, formData)
        .then(result => {
          if (!result) {
            const referrer = document.referrer;
            if (referrer.includes('edit')) {
              window.location.href = referrer;
            } else {
              window.location.href = 'calculators';
            }
          } else {
            // add number to error array and add div to every card to display error message
            // scroll to error message
            let errorMessages = document.querySelectorAll('.registration-form__error');
            for (let errorMessage of errorMessages) {
              errorMessage.innerHTML = '';
            }
            let inputs = document.querySelectorAll('input, textarea');
            for (let input of inputs) {
              input.style.borderColor = '#ced4da';
            }
            for (const [key, value] of Object.entries(result)) {
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

function calculators() {
  // copying iframe text, to include in another page

  const copyButtons = document.querySelectorAll('.iframe-copy');

  for (let copyButton of copyButtons) {
    copyButton.addEventListener('click', e => {
      e.preventDefault();
      const container = e.currentTarget.parentElement;
      let copyText = container.querySelector('.iframe-text');
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      document.execCommand("copy");
      copyText.setSelectionRange(0, 0);
    });
  }
  const cards = document.querySelectorAll('.card');

  for (let card of cards) {
    card.addEventListener('click', e => {
      if (e.target.classList.contains('modal-toggle')) {
        let modal = card.querySelector('.modal-overlay');
        modal.classList.toggle('active');
      }
    });
  }
}

function create_calculator() {
  const form = document.querySelector('form');

  form.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(form);
    formData.append('submit', '');
    const url = 'include/create_calculator.inc.php';
    let inputs = document.querySelectorAll('input[type="text"], select');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if (errorArray.length < 1) {
      postData(url, formData)
        .then(result => {
          if (!result) {
            window.location.href = 'add_question';
          } else {
            let errorMessages = document.querySelectorAll('.registration-form__error');
            for (let errorMessage of errorMessages) {
              errorMessage.innerHTML = '';
            }
            let inputs = document.querySelectorAll('input, textarea, select');
            for (let input of inputs) {
              input.style.borderColor = '#ced4da';
            }
            for (const [key, value] of Object.entries(result)) {
              field = document.querySelector(`input[name="${key}"]`) ?
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
  const fileUploads = document.querySelectorAll('.form__input-file');

  showImagePreviewOnChange(fileUploads);
}

function edit() {
  const fileUploads = document.querySelectorAll('.form__input-file');
  showImagePreviewOnChange(fileUploads);

  const options = document.querySelectorAll('.card-body__option-container');

  for (let option of options) {
    option.addEventListener('click', e => {
      if (e.target.classList.contains('form__input-file')) {
        const inputFile = e.target;
        inputFile.addEventListener('change', () => {
          let img = inputFile.parentElement.querySelector('img');
          setImage(inputFile, img);
        });
      }
    });
  }
  const edits = document.querySelectorAll('.edit');



  for (let edit of edits) {
    edit.addEventListener('click', e => {
      e.preventDefault();
      const container = e.currentTarget.parentElement.parentElement;
      let editButtonContainer = document.querySelectorAll('.disabling');
      hideFields(editButtonContainer);
      let inputs = container.querySelectorAll('input[type="text"], input[type="color"], input[type="number"], textarea');
      let checkbox = container.querySelectorAll('input[type="checkbox"]');
      let check = checkbox.checked ? '1' : '0';
      let inputFiles = container.querySelectorAll('input[type="file"]');
      let selects = container.querySelectorAll('select');
      //if selects, get their value
      let selectsValue = selects.length > 0 ? selects[0].value : '';
      let images = container.querySelectorAll('img');
      let imagesValuesArray = [];
      getImageValues(images, imagesValuesArray);
      enableInputFields(inputs);
      enableInputFields(checkbox);
      enableInputFields(selects);
      enableInputFields(inputFiles);
      let inputValueArray = getInputValues(inputs);
      let editingButtons = container.querySelectorAll('.editing');
      showFields(editingButtons);
      const cancel = container.querySelector('.cancel');
      cancel.addEventListener('click', e => {
        e.preventDefault();
        returnInitialValueToInputFields(inputs, inputValueArray);
        returnImageValues(images, imagesValuesArray);
        if (selects.length > 0) {
          selects[0].value = selectsValue;
        }
        let fileInputs = container.querySelectorAll('input[type="file"]');
        dontUpdateFileNames(fileInputs);
        disableInputFields(inputs);
        if (checkbox.length > 0) {
          checkbox[0].checked = check == '1' ? true : false;
        }
        disableInputFields(checkbox);
        disableInputFields(selects);
        disableInputFields(inputFiles);
        showFields(editButtonContainer);
        hideFields(editingButtons);
        removeAddedOptionFields(container);
        removeErrorTextAndBorderColor(container);
      });
    });
  }

  const addOptionsButton = document.querySelectorAll('.add-option');

  for (let addOption of addOptionsButton) {
    addOption.addEventListener('click', e => {
      e.preventDefault();
      const container = e.currentTarget.parentElement;
      const optionNumber = container.querySelectorAll('.card-option').length + 1;
      let newOption = document.createElement('div');
      newOption.classList.add('card-option');
      newOption.classList.add('card');
      newOption.classList.add('card-body');
      newOption.classList.add('w-25-gap-m');
      newOption.classList.add('l-w-50-gap-m');
      newOption.classList.add('m-100-gap-m');
      newOption.classList.add('new');
      newOption.innerHTML = `
            <div class="card__header w-100 p-none card__header-border d-flex jc-sb ai-c mb-xm">
                <h3>Option ${optionNumber}</h3>
            </div>
            <div class="card-option__body">
                <p class="error-message mb-xs"></p>
                <div class="mb-xm">
                    <label for="${optionNumber}new-optionName">Name</label>
                    <input type="text" class="form__input" name="${optionNumber}new-optionName" id="${optionNumber}new-optionName">
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xm">
                    <label for="${optionNumber}new-optionPrice">Price</label>
                    <input type="number" class="form__input" name="${optionNumber}new-optionPrice" id="${optionNumber}new-optionPrice">
                    <span class="registration-form__error"></span>    
                </div>
                <div>
                    <input type="file" class="form__input-file" name="${optionNumber}new-optionImage" id="${optionNumber}new-optionImage">
                    <label for="${optionNumber}new-optionImage" class="file-label mb-xs">Upload Image <i class="fas fa-plus hide-icon"></i></label>
                    <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
                    <img src="" class="w-100">
                    <span class="registration-form__error"></span>    
                </div>
            </div>
        `;
      container.querySelector('.card-body__option-container').appendChild(newOption);
    });
  }

  const forms = document.querySelectorAll('.question-form');

  for (let form of forms) {
    form.addEventListener('submit', e => {
      e.preventDefault();
      let formData = new FormData(form);
      formData.append('submit', '');
      const url = '../include/update_question.inc.php';
      let errorArray = [];
      let inputs = form.querySelectorAll('input[type="text"], input[type="number"]');
      isEmpty(inputs, errorArray);
      if (errorArray.length < 1) {
        postData(url, formData)
          .then(result => {
            if (!result) {
              location.reload();
            } else {
              let errorMessages = document.querySelectorAll('.registration-form__error');
              for (let errorMessage of errorMessages) {
                errorMessage.innerHTML = '';
              }
              let inputs = document.querySelectorAll('input, textarea');
              for (let input of inputs) {
                input.style.borderColor = '#ced4da';
              }
              for (const [key, value] of Object.entries(result)) {
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
    let inputs = calculatorForm.querySelectorAll('input[type="text"], select');
    isEmpty(inputs, errorArray);
    if (errorArray.length < 1) {
      postData(url, formData)
        .then(result => {
          if (!result) {
            location.reload();
          } else {
            let errorMessages = document.querySelectorAll('.registration-form__error');
            for (let errorMessage of errorMessages) {
              errorMessage.innerHTML = '';
            }
            let inputs = document.querySelectorAll('input, textarea');
            for (let input of inputs) {
              input.style.borderColor = '#ced4da';
            }
            for (const [key, value] of Object.entries(result)) {
              let field = document.querySelector(`input[name="${key}"]`) ?
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


}

function estimate() {
  if (window.location !== window.parent.location) {
    let navs = document.querySelectorAll('nav');
    for (let nav of navs) {
      nav.style.display = 'none';
    }
    document.querySelector('main').style.margin = '0 auto';
  }
  let contact = document.getElementById('contact');
  let btn = document.getElementById('send');
  
  contact.addEventListener('submit', e => {
    e.preventDefault();
    let resultDiv = document.getElementById('result-div');
    let inputs = document.querySelectorAll('input');
    let errorArray = [];
    isEmptyForSmallNumberOfInputs(inputs, errorArray);
    if (errorArray.length < 1) {
      const url = '../include/send_email.inc.php';
      let data = new FormData(contact);
      data.append('submit', '');
      btn.innerHTML = 'Sending...'
      postData(url, data)
        .then(result => {
          if (!result) {
            resultDiv.classList.add('text-center');
            resultDiv.innerHTML = `<h2>Email successfully send.</h2>`;
          } else {
            btn.innerHTML = 'Contact Us! <i class="fas fa-envelope hide-icon"></i>';
            let errorMessages = document.querySelectorAll('.registration-form__error');
            for (let errorMessage of errorMessages) {
              errorMessage.innerHTML = '';
            }
            let inputs = document.querySelectorAll('input, textarea, select');
            for (let input of inputs) {
              input.style.borderColor = '#ced4da';
            }
            for (const [key, value] of Object.entries(result)) {
              field = document.querySelector(`input[name="${key}"]`) ?
                document.querySelector(`input[name="${key}"]`)
                : document.querySelector(`textarea[name="${key}"]`) ?
                  document.querySelector(`textarea[name="${key}"]`)
                  : document.querySelector(`select[name="${key}"]`);
              field.style.borderColor = '#a94442';
              field.parentElement.querySelector('.registration-form__error').innerHTML = value;
            }
          }
        })
    }
  });
}

function login() {
  const registrationForm = document.querySelector('form');

  registrationForm.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(registrationForm);
    formData.append('submit', '');
    const url = 'include/login.inc.php';
    let inputs = document.querySelectorAll('input');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if (errorArray.length < 1) {
      postData(url, formData)
        .then(data => {
          if (!data) {
            window.location.href = 'calculators';
          } else {
            let errorMessage = document.querySelectorAll('.registration-form__error')[1];
            errorMessage.innerHTML = data['error'];
            let inputs = document.querySelectorAll('input');
            for (let input of inputs) {
              input.style.borderColor = '#a94442'
            }
          }
        });
    }
  }); 
}

function register() {
  const registrationForm = document.querySelector('form');

  registrationForm.addEventListener('submit', e => {
    e.preventDefault();
    let formData = new FormData(registrationForm);
    formData.append('submit', '');
    const url = 'include/register.inc.php';
    let inputs = document.querySelectorAll('input');
    let errorArray = [];
    isEmpty(inputs, errorArray);
    if (errorArray.length < 1) {
      postData(url, formData)
        .then(result => {
          if (!result) {
            window.location.href = 'login';
          } else {
            let usernameError = document.querySelector('.registration-form__error.username');
            let emailError = document.querySelector('.registration-form__error.email');
            let passwordErrors = document.querySelectorAll('.registration-form__error.password');
            usernameError.innerHTML = result['username'] ?? '';
            usernameError.parentElement.querySelector('input').style.borderColor = result['username'] ? '#a94442' : '#ced4da';
            emailError.innerHTML = result['email'] ?? '';
            emailError.parentElement.querySelector('input').style.borderColor = result['email'] ? '#a94442' : '#ced4da';
            for (let passwordError of passwordErrors) {
              passwordError.innerHTML = result['password'] ?? '';
              passwordError.parentElement.querySelector('input').style.borderColor = result['password'] ? '#a94442' : '#ced4da';
            }
          }
        });
    }
  });
}

function calculator_users() {
  calculatorId = document.getElementById('calculator');
  let resultDiv = document.getElementById('result');
  let statistics = document.getElementById('statistics');
  calculatorId.addEventListener('change', e => {
    if(e.currentTarget.value == '') {
      resultDiv.innerHTML = '';
      statistics.innerHTML = '';
    } else {
      let url = 'include/get_forms.inc.php?id=' + calculatorId.value;
      getData(url)
      .then(result => {
        if(result) {
          let div = displayCalculatorUsers(result);
          statistics.innerHTML = displayStatistics(result);
          resultDiv.innerHTML = div;
        } else {
          resultDiv.innerHTML = '<h2> Calculator not used... </h2>'
          statistics.innerHTML = '';
        }
      });
    }
  });

  function displayStatistics(result) {
    let number = result.length - 1;
    let div = `
    <div class="d-flex gap-m l-flex-column">
      <div class="w-50-gap-m l-w-100">
        <h3 class="mb-xs">Number of calculator users</h3>
        <p class="mb-xs">Number of user who filled out form: ${result[number]['countWithForm']}</p>
        <p class="mb-xs">Number of user who didn't fill out form: ${result[number]['countWithNoForm']}</p>
        <p class="mb-xm">Total number of users: ${result[number]['count']}</p>
      </div>
      <div class="w-50-gap-m l-w-100"></div>
      </div> 
      <div class="d-flex gap-m l-flex-column">
       <div class="w-50-gap-m l-w-100"> 
        <h3 class="mb-xs">Total price</h3>
        <p class="mb-xs">Total price for users who didn't fill out form: ${result[number]['totalWithNoForm']}${result[number]['currency']}</p>
        <p class="mb-xs">Total price for users who filled out form: ${result[number]['totalWithForm']}${result[number]['currency']}</p>
        <p class="mb-xm">Total price for all users: ${result[number]['total']}${result[number]['currency']}</p>
        </div>
        <div class="w-50-gap-m l-w-100">
        <h3 class="mb-xs">Average estimate price</h3>
        <p class="mb-xs">Average estimate price for users who didn't fill out form: ${result[number]['averageEstimateWithNoForm']}${result[number]['currency']}</p>
        <p class="mb-xs">Average estimate price for users who filled out form: ${result[number]['averageEstimateWithForm']}${result[number]['currency']}</p>
        <p class="mb-xm">Average estimate price for all users: ${result[number]['averageEstimate']}${result[number]['currency']}</p>
       </div> 
      </div>
        <p class="mb-xm">Calculator last time used: ${result[number]['date']}</p>
    `;
    return div;
  }

  function displayCalculatorUsers(result) {
    let div = '';
    for(let calculator of result) {
      if(!calculator['id']) {
        continue;
      } else {
        div += displayCalculatorUser(calculator);
      }
    }
    return div;
  }

  function displayCalculatorUser(result) {
    let div = `
      <div class="calculator card w-25-gap-m l-w-50-gap-m m-w-100">
        <h2 class="calculator__heading p-xs w-100 text-center"> ${result['calculatorName']} </h2>
        <div class="card-body">
          ${displayCalculatorStepsAndOptions(result['steps'])}
          <p class="mb-xs"><strong>User total: </strong> ${result['estimate']}${result['currency']}</p>
          <p class="mb-xs"><strong>User name: </strong>${result['userName']}</p>
          ${showEmail(result)}
          ${showText(result)}
        </div>
      </div>
    `;
    return div;
  }

  function showEmail(result) {
    if(result['email']) {
      return ` <p class="mb-xs"><strong>User email: </strong>${result['email']}</p>`
    }
    return '';
  }
  function showText(result) {
    if(result['text']) {
      return `<p class="mb-xs"><strong>User text: </strong>${result['text']}</p>`
    }
    return '';
  }

  function displayCalculatorStepsAndOptions(steps) {
    let div = '';
    let i = 1;
    for(let step of steps) {
      div += `
        <p class="mb-xs">${i}. ${step['name']}</p>
        <p class="mb-xs">Choosen option: ${step['option']}</p>
        <p class="mb-xm">Choosen option price: ${step['price']}</p>
        `;
        i++;
    }
    return div;
  }

}




const toggle = document.getElementById('sidebar-toggle');
let sidebar = document.querySelector('.sidebar');
let main = document.querySelector('main');
let navigation = document.querySelector('.navigation');
let sidebarOverlay = document.querySelector('.sidebar-overlay');
let sidebarMenuDropdowns = document.querySelectorAll('.sidebar__dropdown-toggle');

let widthScreen = window.innerWidth
  || document.documentElement.clientWidth
  || document.body.clientWidth;


if (widthScreen > 992) {
  toggleActiveClass();
}
window.addEventListener('resize', e => {
  let widthScreen = window.innerWidth
    || document.documentElement.clientWidth
    || document.body.clientWidth;
  if (widthScreen < 586) {
    sidebar.classList.remove('active');
    main.classList.remove('active');
    navigation.classList.remove('active');
    toggle.classList.remove('active');
    sidebarOverlay.classList.remove('active');
  }
  if (widthScreen > 992) {
    sidebar.classList.add('active');
    main.classList.add('active');
    navigation.classList.add('active');
    toggle.classList.add('active');
    sidebarOverlay.classList.add('active');
  }
});

if(toggle) {
  toggle.addEventListener('click', () => {
    toggleActiveClass();
  });
}

if(sidebarOverlay) {
  sidebarOverlay.addEventListener('click', () => {
    toggleActiveClass();
  });
}

for (let sidebarMenuDropdownToggle of sidebarMenuDropdowns) {
  sidebarMenuDropdownToggle.addEventListener('click', e => {
    let sidebarMenuDropdown = sidebarMenuDropdownToggle.querySelector('.sidebar__menu-dropdown');
    if (!sidebarMenuDropdown.offsetHeight != 0) {
      sidebarMenuDropdownToggle.classList.add('sidebar__dropdown-active');
      let sidebarMenuItem = sidebarMenuDropdown.querySelectorAll('li');
      let sidebarMenuItemHeight = sidebarMenuItem[0].offsetHeight * sidebarMenuItem.length;
      sidebarMenuDropdown.style.height = `${sidebarMenuItemHeight}px`;
    } else {
      sidebarMenuDropdownToggle.classList.remove('sidebar__dropdown-active');
      sidebarMenuDropdown.style.height = '0';
    }
  });
}

function toggleActiveClass() {
  sidebar.classList.toggle('active');
  main.classList.toggle('active');
  navigation.classList.toggle('active');
  toggle.classList.toggle('active');
  sidebarOverlay.classList.toggle('active');
  if (!sidebar.classList.contains('active')) {
    for (let sidebarMenuDropdownToggle of sidebarMenuDropdowns) {
      let sidebarMenuDropdown = sidebarMenuDropdownToggle.querySelector('.sidebar__menu-dropdown');
      sidebarMenuDropdownToggle.classList.remove('sidebar__dropdown-active');
      sidebarMenuDropdown.style.height = '0';
    }
  }
}

let checkbox = document.getElementById('theme-toggle');
let userImage = document.getElementById('theme-image');
let logoImage = document.getElementById('theme-logo');

if(checkbox) {
  checkbox.addEventListener('click', function () {
    let getUrl = checkbox.getAttribute('data-id');
    let baseUrl = getUrl + 'include/theme.inc.php';
    getData(baseUrl)
      .then(result => {
        if (!result) {
          trans();
          document.documentElement.setAttribute('data-theme', 'dark');
          logoImage.src = getUrl + 'images/logo-2.png';
          userImage.src = getUrl + 'images/default2.png';
        } else {
          trans();
          document.documentElement.setAttribute('data-theme', 'light');
          logoImage.src = getUrl + 'images/logo.png';
          userImage.src = getUrl + 'images/default.png';
        }
      });
  });
}

let trans = () => {
  document.documentElement.classList.add('transition');
  window.setTimeout(() => {
    document.documentElement.classList.remove('transition');
  }, 700);
}

function removeImageAndFileValue() {
  let removeImageIcons = document.querySelectorAll('.remove-image');
  if (removeImageIcons) {
    for (let removeImageIcon of removeImageIcons) {
      removeImageIcon.addEventListener('click', e => {
        removeImageToggle(e.currentTarget, removeImageIcon);
      });
    }
  }
}

removeImageAndFileValue();

function removeImageToggle(e, removeImageIcon) {
  let container = e.parentElement;
  let img = container.querySelector('img');
  let file = container.querySelector('input');
  let fileName = container.querySelector('.file-name');
  if (fileName) {
    fileName.innerHTML = '';
  }
  img.src = '';
  file.value = '';
  if (removeImageIcon.classList.contains('has-value')) {
    file.name += '-updated';
  }
  removeImageIcon.style.display = 'none';
}

async function getData(url) {
  const response = await fetch(url, {
    method: 'GET',
  });
  return response.json(); // parses JSON response into native JavaScript object
}






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
  for (let input of inputFieldsArray) {
    input.removeAttribute('disabled');
  }
}

function getInputValues(inputFieldsArray) {
  let inputValuesArray = [];
  for (let input of inputFieldsArray) {
    const value = input.getAttribute('value');
    inputValuesArray.push(value);
  }
  return inputValuesArray;
}

function disableInputFields(inputFieldsArray) {
  for (let input of inputFieldsArray) {
    input.setAttribute('disabled', 'true');
  }
}

function returnInitialValueToInputFields(inputFieldsArray, inputValueArray) {
  for (let i = 0; i < inputFieldsArray.length; i++) {
    inputFieldsArray[i].value = inputValueArray[i];
  }
}

function hideFields(fields) {
  for (let field of fields) {
    field.style.display = 'none';
  }
}

function showFields(fields) {
  for (let field of fields) {
    field.style.display = 'block';
  }
}

function removeAddedOptionFields(container) {
  let addedFields = container.querySelectorAll('.new');
  for (let addedField of addedFields) {
    addedField.remove();
  }
}

function setImage(inputField, img) {
  img.src = URL.createObjectURL(inputField.files[0]);
  img.onload = function () {
    URL.revokeObjectURL(img.src);
  }
}

function showImagePreviewOnChange(fileUploads) {
  for (let fileUpload of fileUploads) {
    fileUpload.addEventListener('change', e => {
      showImagePreview(e, fileUpload);
    });
  }
}

function showImagePreview(e, fileUpload) {
  const container = e.target.parentElement;
  let img = container.querySelector('img');
  let removeImageIcon = container.querySelector('.remove-image');
  let fileName = container.querySelector('.file-name');
  if (fileName) {
    fileName.innerHTML = fileUpload.files[0].name;
  }
  if (removeImageIcon) {
    removeImageIcon.style.display = 'block';
  }
  setImage(fileUpload, img);
}


function removeErrorTextAndBorderColor(container) {
  let errorMessages = container.querySelectorAll('.registration-form__error');
  for (let errorMessage of errorMessages) {
    errorMessage.innerHTML = '';
  }
  let inputs = container.querySelectorAll('input, textarea, select');
  for (let input of inputs) {
    input.style.borderColor = '#ced4da'
  }
}

function isEmpty(inputs, errorArray) {
    for (let input of inputs) {
    let errorMessage = input.parentElement.querySelector('.registration-form__error');
    if (input.value == '') {
      input.style.borderColor = '#a94442';
      errorMessage.innerHTML = 'Field can\'t be empty';
      errorArray.push('error');
    } else {
      input.style.borderColor = '#ced4da';
      errorMessage.innerHTML = '';
    }
  }
}

function isEmptyForSmallNumberOfInputs(inputs, errorArray) {
    let errorMessages = document.querySelectorAll('.registration-form__error');
    for (i = 0; i < inputs.length; i++) {
      if (inputs[i].value.length < 1) {
        inputs[i].style.borderColor = '#a94442';
        errorMessages[i].innerHTML = 'Field can\'t be empty';
        errorArray.push('error');
      } else {
        inputs[i].style.borderColor = '#ced4da';
        errorMessages[i].innerHTML = '';
      }
  }

}

function getImageValues(images, array) {
  for (let image of images) {
    array.push(image.src);
  }
  return array;
}

function returnImageValues(images, array) {
  for (let i = 0; i < images.length; i++) {
    if (array[i] === window.location.href) {
      images[i].src = '';
    } else {
      images[i].src = array[i];
    }
  }
}

function dontUpdateFileNames(fileInputs) {
  for (let input of fileInputs) {
    inputName = input.name.split('-');
    inputName.pop();
    input.name = inputName.join('-');
  }
}

function hideSidebar() {
  const toggle = document.getElementById('sidebar-toggle');
  let sidebar = document.querySelector('.sidebar');
  let main = document.querySelector('main');
  let navigation = document.querySelector('.navigation');
  if(sidebar) {
    sidebar.classList.add('d-none');
    toggle.classList.add('d-none');
  }
  main.classList.remove('active');
  main.style.margin = '0 auto';
  navigation.classList.remove('active');
  navigation.style.margin = '0 auto';
  showDashboardNavLink();
}

function showDashboardNavLink() {
  let dashboardNavLink = document.getElementById('dashboard-link');
  if(dashboardNavLink) {
    dashboardNavLink.classList.remove('d-none');
  }
}
