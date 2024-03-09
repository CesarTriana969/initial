

/* ============= Settings Custom Links ============= */

document.addEventListener('DOMContentLoaded', function () {
  // Obtén referencias a los elementos del DOM
  const trackOrderActive = document.getElementById('track_order_active');
  const trackOrderActiveBanner = document.getElementById('track_order_active_banner');
  const trackOrderPopUp = document.getElementById('track_order_popUp');

  // Muestra u oculta el formulario al hacer clic en '#contact'
  trackOrderActive?.addEventListener('click', toggleFormDisplay);
  trackOrderActiveBanner?.addEventListener('click', toggleFormDisplay);

  // Oculta el formulario si se hace clic fuera de él
  document.addEventListener('mouseup', function (e) {
    if (!isClickInsideForm(e)) {
      hideForm();
    }
  });

  // Función para mostrar u ocultar el formulario
  function toggleFormDisplay() {
    trackOrderPopUp.style.display = (trackOrderPopUp.style.display === 'none' || trackOrderPopUp.style.display === '') ? 'block' : 'none';
  }

  // Función para comprobar si el clic ocurrió dentro del formulario
  function isClickInsideForm(e) {
    return trackOrderPopUp.contains(e.target) || e.target === trackOrderActive || e.target === trackOrderActiveBanner ;
  }

  // Función para ocultar el formulario
  function hideForm() {
    trackOrderPopUp.style.display = 'none';
  }
});


/* ============= Settings Custom Links ============= */

const currentPath = window.location.pathname;
const links = document.querySelectorAll('.navbar__link');

for (let i = 0; i < links.length; i++) {
  if (links[i].getAttribute('href') === currentPath) {
    links[i].classList.add('active__link');
  }
}