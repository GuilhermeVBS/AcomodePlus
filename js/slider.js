function initializeSlider(sliderElement) {
    let list = sliderElement.querySelector('.list');
    let items = sliderElement.querySelectorAll('.list .item');
    let dots = sliderElement.querySelectorAll('.dots li');
    let prev = sliderElement.querySelector('.prev');
    let next = sliderElement.querySelector('.next');

    let active = 0;
    let lengthItems = items.length - 1;
    let refreshSlider;

    function reloadSlider() {
        let checkLeft = items[active].offsetLeft;
        list.style.left = -checkLeft + 'px';

        let lastActiveDot = sliderElement.querySelector('.dots li.active');
        if (lastActiveDot) lastActiveDot.classList.remove('active');
        dots[active].classList.add('active');

        // clearInterval(refreshSlider);
        // refreshSlider = setInterval(() => { next.click(); }, 5000);
    }

    next.onclick = function () {
        active = (active + 1 > lengthItems) ? 0 : active + 1;
        reloadSlider();
    }

    prev.onclick = function () {
        active = (active - 1 < 0) ? lengthItems : active - 1;
        reloadSlider();
    }

    dots.forEach((li, key) => {
        li.addEventListener('click', function () {
            active = key;
            reloadSlider();
        });
    });
}

// Inicie todos os sliders após o carregamento do DOM
document.querySelectorAll('.slider').forEach(slider => {
    initializeSlider(slider);
});
