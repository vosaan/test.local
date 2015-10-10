function validate(){
  var valide = true;
  
  /* Валидация формы обратной связи */
  
  /* Если поле "Заголовок" не заполнено, выводится соотв. сообщение в блок с id=title_error */
  var t_error = document.getElementById("title_error");
  if(document.feedback.title.value == ""){
    t_error.innerHTML = "Это поле должно быть заполнено!";
    valide = false;
  }

  /* Регулярное выражение для проверки формата адреса электронной почты */
  reg = /^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,12})$/;
  /*
   * Если поле "e-mail" не заполнено или имеет неверный формат, 
   * выводится соотв. сообщение в блок с id=email_error 
   */
  var email_error = document.getElementById("email_error");
  if(document.feedback.email.value == ""){
    email_error.innerHTML = "Это поле должно быть заполнено!";
    valide = false;
  } else if (!document.feedback.email.value.match(reg)){
    email_error.innerHTML = "Неверный формат e-mail"; 
    valide = false; 
  }
  
  /* Если поле "Отзыв" не заполнено, выводится соотв. сообщение в блок с id=message_error */
  var m_error = document.getElementById("message_error");
  if(document.feedback.message.value == ""){
    m_error.innerHTML = "Это поле должно быть заполнено!";
    valide = false;
  }

  return valide;
}

function reg_validate(){
  var reg_valide = true;
  var err_mess1 = "Это поле должно быть заполнено!"

  if(document.reg.reg_form_login.value == ""){
    document.getElementById("reg_l_error").innerHTML = err_mess1;
    reg_valide = false;
  }

  if(document.reg.reg_form_password.value == ""){
    document.getElementById("reg_p_error").innerHTML = err_mess1;
    reg_valide = false;
  }

  if(document.reg.reg_form_password_confirm.value == ""){
    document.getElementById("reg_p_c_error").innerHTML = err_mess1;
    reg_valide = false;
  }   

  return reg_valide;
}