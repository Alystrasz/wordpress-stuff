// https://mdbootstrap.com/snippets/standard/mdbootstrap/2964350

// Get the button
let mybutton = document.querySelector(".back-to-top-btn");

const SCROLL_TOP_MIN_VALUE = 200;

function scrollFunction(event) {
  if ( event.target.scrollTop > SCROLL_TOP_MIN_VALUE ) {
    mybutton.classList.add('show-back-to-top-btn');
  } else {
    mybutton.classList.remove('show-back-to-top-btn');
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
    overlayScrollbars.scroll(0, 600);
}

let overlayScrollbars;
document.addEventListener("DOMContentLoaded", function() {
	overlayScrollbars = OverlayScrollbars(document.querySelectorAll("body"), {
        scrollbars: {
            autoHide: 'scroll'
        },
        callbacks: {
            onScroll: scrollFunction
        }
     });
});