  function validate(){
    var valide = true;
    
    var t_error = document.getElementById("title_error");
    if(document.feedback.title.value == ""){
      t_error.innerHTML = "Это поле должно быть заполнено!";
      valide = false;
    }

    reg = /^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,12})$/;
    
    var email_error = document.getElementById("email_error");
    if(document.feedback.email.value == ""){
      email_error.innerHTML = "Это поле должно быть заполнено!";
      valide = false;
    } else if (!document.feedback.email.value.match(reg)){
      email_error.innerHTML = "Неверный формат e-mail"; 
      valide = false; 
    }
    
    var m_error = document.getElementById("message_error");
    if(document.feedback.message.value == ""){
      m_error.innerHTML = "Это поле должно быть заполнено!";
      valide = false;
    }

    return valide;
  }