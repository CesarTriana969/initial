const form = document.getElementById('track_your_order_form');


function validateNumericFieldContact(input) {
  input.value = input.value.replace(/[^0-9]/g, '');
}


function validateName(value) {
  const expression = /^[a-zA-ZÀ-ÿ\s]{2,32}$/;
  return expression.test(value);
}


function validateEmail(value) {
  const expression = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
  return expression.test(value);
}


function validateNumber(value) {
  const expression = /^\d{7,14}$/;
  return expression.test(value);
}


function validateMessage(value) {
  const messageExpression = /^[a-zA-ZÀ-ÿ\s\d+.,_"&;:\-?!${}()|[\]\\]{4,255}$/;
  const urlExpression = /(((ftp|http|https):\/\/)?(www\.)?([A-z-\d]+)\.([A-z]{2,}))/;

  return messageExpression.test(value) && !urlExpression.test(value);
}


function getValidationsFields(inputName) {
  const validateFields = {
    name: validateName,
    email: validateEmail,
    phone: validateNumber,
    meeting_prep: validateMessage,
  };

  return validateFields[inputName];
}


function showCustomAlertContact(icon, title, text, options) {
  Swal.fire({
    icon: icon,
    title: title,
    text: text,
    customClass: {
      container: 'custom__alert-validate--container',
      popup: 'custom__alert-validate--popup',
      title: 'custom__alert-validate--title',
      content: 'custom__alert-validate--content',
      icon: 'custom__alert-validate--icon',
      confirmButton: 'custom__alert-validate--btn',
    },
  });
}


function showCustomAlertLoading(icon, title, text, options) {
  Swal.fire({
    icon: icon,
    title: title,
    text: text,
    customClass: {
      container: 'custom__alert-validate--container',
      popup: 'custom__alert-validate--popup',
      title: 'custom__alert-validate--title',
      content: 'custom__alert-validate--content',
      icon: 'custom__alert-validate--icon',
    },
    ...options,
  });
}


function showLoadingPopup() {
  showCustomAlertLoading(
    'info',
    'Saving...',
    'Please wait...',
    {
      didOpen: () => {
        Swal.showLoading();
        timerInterval = setInterval(() => {
          const content = Swal.getHtmlContainer();
          if (content) {
            const b = content.querySelector('b');
            if (b) {
              b.textContent = Swal.getTimerLeft();
            }
          }
        }, 100);
      },
      allowOutsideClick: false,
      showConfirmButton: false,
    }
  );
}


function validateContactForm(form) {
  const alerts = form.querySelectorAll('.alert__form');
  const inputs = form.querySelectorAll('.input__form');
  let contador = 0;

  alerts.forEach((alert) => (alert.textContent = ''));
  inputs.forEach((input) => input.classList.remove('error__input'));

  const customMessages = {
    name: 'Please Enter a Valid Name.',
    email: 'Please Enter a Valid Email Address.',
    phone: 'Please Enter a Valid Phone Number.',
    meeting_prep: 'Please Enter a Valid Comments',
  };

  for (let i = 0; i < form.elements.length; i++) {
    const element = form.elements[i];

    if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
      const validateField = getValidationsFields(element.name);

      if (validateField && !validateField(element.value)) {
        const alertId = element.name + '_error';
        element.classList.add('error__input');

        const errorMessage = customMessages[element.name] || `Please Enter a Valid ${element.name}.`;
        form.querySelector(`#${form.id} #${alertId}`).textContent = errorMessage;
        contador++;
      } else {
        element.classList.remove('error__input');
      }
    }
  }

  if (contador === 0) {
    showLoadingPopup();
    form.submit();
  } else {
    const firstAlert = form.querySelector('.alert__form:not(:empty)');

    if (firstAlert) {
      showCustomAlertContact("warning", firstAlert.textContent, "Try again!");
    }
  }
}


form.addEventListener('submit', (event) => {
  event.preventDefault();
  validateContactForm(form);
});