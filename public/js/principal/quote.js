document.addEventListener("DOMContentLoaded", function () {
  const annualRight = document.getElementById("annual_right");
  let container = document.querySelector(".quote__items-content");

  function handleScroll() {
    const containerHeight = container.scrollHeight;
    const scrolling = 0.50 * containerHeight;
    const secondRuleScrolling = 0.023 * containerHeight;
    const scrollPosition = window.scrollY;

    if (scrollPosition < containerHeight) {
      const isAtTop = scrollPosition === 0;
      const isPastScrolling = scrollPosition > scrolling;
      const isPastSecondRule = scrollPosition > secondRuleScrolling;

      annualRight.classList.toggle("absolute__progress", !isAtTop && isPastScrolling);
      annualRight.classList.toggle("position__progress", isPastSecondRule);
    }
  }

  function handleResize() {
    container = document.querySelector(".quote__items-content");
    handleScroll();
  }

  window.addEventListener("scroll", handleScroll);
  window.addEventListener("resize", handleResize);

  handleResize();
});
