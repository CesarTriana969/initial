function scrollPageToTop() {
  document.documentElement.scrollTop = 0;
}


function main() {
  return {
    currentSection: 1,
    nextSection(next) {
      this.currentSection = next;
      scrollPageToTop();
    },
    previousSection() {
      this.currentSection--;
      scrollPageToTop();
    },
  }
}