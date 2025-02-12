//types controoling
let clickers = document.querySelectorAll(".type-click");
let items = document.querySelectorAll(".item");
clickers.forEach((ele, index) => {
  ele.addEventListener("click", (e) => {
    items[index].classList.toggle("d-none");
  });
});
//customize arrow abselute
let arrow = document.querySelector(".arrow");
arrow.style.width = `${window.innerWidth / 4.1 - 140}px`;
arrow.style.right = `${window.innerWidth / 2 - 150}px`;

let sec = document.querySelector("section.ways");
let arrowt = document.querySelector(".arrow.t");
arrowt.style.position = "abselute";
arrowt.style.width = `${window.innerWidth / 4.1 - 140}px`;
arrowt.style.right = `-${window.innerWidth / 12}px`;
arrowt.style.transform = `rotate(180deg)`;

let secc = document.querySelector("section.help");
let ar = document.querySelector("section.help .arrow");
ar.style.position = "abselute";
ar.style.width = `${window.innerWidth / 4.1 - 120}px`;
ar.style.right = `${window.innerWidth / 2 - 350}px`;

