if(window.location !== window.parent.location) {
    let navs = document.querySelectorAll('nav, sidebar');
    for(let nav of navs) {
        nav.style.display = 'none';
    }
}
