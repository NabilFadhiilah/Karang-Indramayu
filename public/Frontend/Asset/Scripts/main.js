var swiper = new Swiper(".swiper", {
  direction: "horizontal",
  centeredSlides: false,
  spaceBetween: 20,
  freeMode: true,
  breakpoints: {
    786: {
      slidesPerView: 4,
      slidesPerGroup: 2,
    },
  },
});

//Counter
let counterDisplayElem = document.querySelector("#counter-display");
let counterMinusElem = document.querySelector("#counter-minus");
let counterPlusElem = document.querySelector("#counter-plus");

let count = 1;

updateDisplay();

counterPlusElem.addEventListener("click", () => {
  count++;
  updateDisplay();
});

counterMinusElem.addEventListener("click", () => {
  count--;
  updateDisplay();
});

function updateDisplay() {
  counterDisplayElem.value = count;
}
