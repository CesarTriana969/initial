/* ============= Settings Custom Links ============= */

const currentPathFooter = window.location.pathname;
const footerLinks = document.querySelectorAll('.footer__link');

for (let i = 0; i < footerLinks.length; i++) {
  if (footerLinks[i].getAttribute('href') === currentPathFooter) {
    footerLinks[i].classList.add('active__link');
  }
}