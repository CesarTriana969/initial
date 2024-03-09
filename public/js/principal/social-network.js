
const nav = document.querySelector(".draggable__circle");
const toggleBtn = document.querySelector(".social__network-btn");

toggleBtn.addEventListener("click", () => {
  nav.classList.toggle("open");
});

nav.addEventListener("mousedown", () => {
  nav.addEventListener("mousemove", onDrag);
});

function onDrag({
  movementY
}) {

  const navStyle = window.getComputedStyle('.draggable__circle');

  const navTop = parseInt(navStyle.top);

  const navHeight = parseInt(navStyle.height);

  const windowHeight = window.innerHeight;

  nav.style.top = navTop > 0 ? `${navTop + movementY}px` : "1px";
  if (navTop > windowHeight - navHeight) {
    nav.style.top = `${windowHeight - navHeight}px`;
  }
}

nav.addEventListener("mouseup", () => {
  nav.removeEventListener("mousemove", onDrag);
});

nav.addEventListener("mouseleave", () => {
  nav.removeEventListener("mousemove", onDrag);
});