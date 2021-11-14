// https://stackoverflow.com/a/57991537

// get the sticky element
const stickyElm = document.querySelector('.nav-bar-container');
const brand = document.querySelector('.navbar-brand');
const navbarMenu = document.querySelector('#navbar-menu-container');

const observer = new IntersectionObserver( 
  ([e]) => {
      const intersecting = e.intersectionRatio < 1;
      const isIntersectingScreenTop = e.boundingClientRect.top === -1;
      const shouldShow = intersecting && isIntersectingScreenTop;

      brand.classList.toggle('navbar-brand-visible', shouldShow);
      navbarMenu.classList.toggle('navbar-menu-container-no-translation', shouldShow);
  },
  {threshold: [1]}
);

observer.observe(stickyElm)