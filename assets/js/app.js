// loads the Bootstrap jQuery plugins
import 'bootstrap-sass/assets/javascripts/bootstrap/transition.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/alert.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/collapse.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/dropdown.js';
import 'bootstrap-sass/assets/javascripts/bootstrap/modal.js';

// loads the code syntax highlighting library
import './highlight.js';

// Creates links to the Symfony documentation
import './doclinks.js';

let btn_left = document.querySelector('.left');
let btn_right = document.querySelector('.right');
let imgs = document.querySelectorAll('.carousel img');
let wrap = document.querySelector('.carousel-wrap');

let counter = 0;

let wrap_width = wrap.offsetWidth;
wrap.style.width = (wrap_width * imgs.length) + 'px';

btn_left.addEventListener('click', function () {
    if (counter > 0) {
        counter--;
    } else {
        counter = imgs.length - 1;
    }

    wrap.style.marginLeft = (-wrap_width * counter) + 'px';
});

btn_right.addEventListener('click', function () {
    if (counter < imgs.length - 1) {
        counter++;
    } else {
        counter = 0;
    }

    wrap.style.marginLeft = (-wrap_width * counter) + 'px';
});