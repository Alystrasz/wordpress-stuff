if (document.querySelector('.articles-images-slider') !== null) {
    tns({
        container: '.articles-images-slider',
        items: 1,
        autoplay: true,
        axis: 'vertical',
        touch: false,
        nav: false,
        controls: false,
        center: true,
        autoplayButtonOutput: false
    });
}

if (document.querySelector('.articles-texts-slider') !== null) {
    tns({
        container: '.articles-texts-slider',
        mode: 'gallery',
        items: 1,
        autoplay: true,
        nav: true,
        controls: false,
        autoplayButtonOutput: false,
        touch: false,
        speed: 750
    });
}
