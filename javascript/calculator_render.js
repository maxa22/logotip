if(window.location !== window.parent.location) {
    let navs = document.querySelectorAll('nav, .sidebar');
    for(let nav of navs) {
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

for( let input of inputs) {
    input.addEventListener('click', () => {
        showNextQuestion();
    })
}

function showNextQuestion() {
    if(count < divs.length) {
    divs[count].style.display = 'block';
    divs[count].scrollIntoView();
    count++;
    }
}

