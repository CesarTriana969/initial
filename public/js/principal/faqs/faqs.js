/* ============= FREQUENTLY ASKED QUESTIONS ============= */

document.addEventListener('DOMContentLoaded', function () {
  const servicesFaqsItem = document.querySelectorAll('.services__faqs-item');

  servicesFaqsItem.forEach(function (item, index) {
    const servicesFaqsHeader = item.querySelector('.services__faqs-header');
    const servicesFaqsText = item.querySelector('.services__faqs-text');
    const downIcon = item.querySelector('.down');
    const upIcon = item.querySelector('.up');
    const servicesFaqsNumber = item.querySelector('.services__faqs-number');

    const number = (index + 1).toString();
    servicesFaqsNumber.textContent = number;

    downIcon.style.display = 'block';
    upIcon.style.display = 'none';

    servicesFaqsHeader.addEventListener('click', function (e) {
      const isOpen = servicesFaqsText.clientHeight > 0;

      if (!isOpen) {
        closeAllAccordions();
        servicesFaqsText.style.height = servicesFaqsText.scrollHeight + 'px';
        downIcon.style.display = 'none';
        upIcon.style.display = 'block';
      } else {
        servicesFaqsText.style.height = '0';
        downIcon.style.display = 'block';
        upIcon.style.display = 'none';
      }

      e.preventDefault();
    });

    if (index === 0) {
      servicesFaqsText.style.height = servicesFaqsText.scrollHeight + 'px';
      downIcon.style.display = 'none';
      upIcon.style.display = 'block';
    }
  });

  function closeAllAccordions() {
    servicesFaqsItem.forEach(function (item) {
      const answers = item.querySelector('.services__faqs-text');
      const downIcon = item.querySelector('.down');
      const upIcon = item.querySelector('.up');

      answers.style.height = '0';
      downIcon.style.display = 'block';
      upIcon.style.display = 'none';
    });
  }
});