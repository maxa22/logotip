const cards = document.querySelectorAll('.card');

for(let card of cards) {
    card.addEventListener('click', e => {
        if(e.target.classList.contains('modal-toggle')) {
            let modal = card.querySelector('.modal-overlay');
            modal.classList.toggle('active');
        }
    });
}