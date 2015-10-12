    function showError(container, errorMessage) {
      container.className = 'error';
      var msgElem = document.createElement('div');
      msgElem.className = "valid_error";
      msgElem.innerHTML = errorMessage;
      container.appendChild(msgElem);
      window.validated = false;
    }

    function resetError(container) {
    	console.log(container.className)
      	container.className = '';
      	if (container.lastChild.className == "valid_error") {
        	container.removeChild(container.lastChild);
      	}
    }

    function feed_validate(feedback) {
      window.validated = true;
      var elems = feedback.elements;

      resetError(elems.title.parentNode);
      if (!elems.title.value) {
        showError(elems.title.parentNode, ' Укажите заголовок!');
      }

      reg_email = /^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,12})$/;

      resetError(elems.email.parentNode);
      if (!elems.email.value) {
        showError(elems.email.parentNode, ' Укажите e-mail!');
      } else if (!elems.email.value.match(reg_email)){
        showError(elems.email.parentNode, ' Неверный формат e-mail!');
      }

      resetError(elems.message.parentNode);
      if (!elems.message.value) {
        showError(elems.message.parentNode, ' Отсутствует текст отзыва!');
      }

      if(window.validated) {
        document.forms.feedback.submit();
      }
    }

    function reg_validate(reg) {
      window.validated = true;
      var elems = reg.elements;
      reg_login = /^[a-z0-9_-]{3,15}$/;
      reg_password = /^[a-z0-9_-]{6,15}$/;
          
      resetError(elems.reg_form_login.parentNode);
      if (!elems.reg_form_login.value) {
        showError(elems.reg_form_login.parentNode, ' Укажите логин!');
      } else if (!elems.reg_form_login.value.match(reg_login)) {
        showError(elems.reg_form_login.parentNode, ' Неверный формат логина!');
      }

      resetError(elems.reg_form_password.parentNode);
      if (!elems.reg_form_password.value) {
        showError(elems.reg_form_password.parentNode, ' Укажите пароль!');
      } else if (!elems.reg_form_password.value.match(reg_password)) {
        showError(elems.reg_form_password.parentNode, ' Неверный формат пароля!');
      } else if (elems.reg_form_password.value != elems.reg_form_password_confirm.value) {
        showError(elems.reg_form_password.parentNode, ' Пароли не совпадают!');
      }

      resetError(elems.reg_form_password_confirm.parentNode);
      if (!elems.reg_form_password_confirm.value) {
        showError(elems.reg_form_password_confirm.parentNode, ' Укажите пароль!');
      } else if (!elems.reg_form_password_confirm.value.match(reg_password)) {
        showError(elems.reg_form_password_confirm.parentNode, ' Неверный формат пароля!');
      } else if (elems.reg_form_password.value != elems.reg_form_password_confirm.value) {
        showError(elems.reg_form_password_confirm.parentNode, ' Пароли не совпадают!');
      }            

      /*resetError(elems.message.parentNode);
      if (!elems.message.value) {
        showError(elems.message.parentNode, ' Отсутствует текст отзыва!');
      }*/

      if(window.validated) {
        document.forms.reg.submit();
      }
    }

    function login_validate(login){
      window.validated = true;
      var elems = login.elements;

      resetError(elems.auth_form_login.parentNode);
      if (!elems.auth_form_login.value) {
        showError(elems.auth_form_login.parentNode, ' Укажите логин!');
      }

      resetError(elems.auth_form_password.parentNode);
      if (!elems.auth_form_password.value) {
        showError(elems.auth_form_password.parentNode, ' Укажите логин!');
      }
      
      if(window.validated) {
        document.forms.login.submit();
      }              
    }
