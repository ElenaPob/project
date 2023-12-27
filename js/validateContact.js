var form = document.getElementById("formularioContacto");
var error = document.getElementsByClassName("errorShow");
var errorForm = document.getElementsByClassName("errorForm")[0];
var succesForm = document.getElementsByClassName("succesForm")[0];



var regexEmail = /^[^\s@]+@[^\s@]+.[^\s@]+$/;
var regexText = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/;

form.nombre.addEventListener("input", function (){
    if(form.nombre.value.length === 0){
        error[0].textContent="Este campo no puede estar vacío";
    }else if(!regexText.test(form.nombre.value)){
        error[0].textContent="El nombre no es válido";
    }else{
        error[0].textContent="";
    }
});
form.email.addEventListener("input", function (){
    if(form.email.value.length === 0){
        error[1].textContent="Este campo no puede estar vacío";
    }else if(!regexEmail.test(form.email.value)){
        error[1].textContent="El email no es válido";
    }else{
        error[1].textContent="";
    }
});
form.asunto.addEventListener("input", function (){
    if(form.asunto.value.length === 0){
        error[2].textContent="Este campo no puede estar vacío";
    }else if(!regexText.test(form.asunto.value)){
        error[2].textContent="El asunto no es válido";
    }else{
        error[2].textContent="";
    }
});
form.mensaje.addEventListener("input", function (){
    if(form.mensaje.value.length === 0){
        error[3].textContent="Este campo no puede estar vacío";
    }else{
        error[3].textContent="";
    }
});



form.addEventListener("submit", function(e){
    e.preventDefault();
    var sinError = true;

    if(form.nombre.value.length === 0 || !regexText.test(form.nombre.value)){
        error[0].textContent = (form.nombre.value.length === 0) ? "Este campo no puede estar vacío" : "El nombre no es válido";
        sinError = false;
    } else {
        error[0].textContent = "";
    }

    if(form.email.value.length === 0 || !regexEmail.test(form.email.value)){
        error[1].textContent = (form.email.value.length === 0) ? "Este campo no puede estar vacío" : "El email no es válido";
        sinError = false;
    } else {
        error[1].textContent = "";
    }

    if(form.asunto.value.length === 0 || !regexText.test(form.asunto.value)){
        error[2].textContent = (form.asunto.value.length === 0) ? "Este campo no puede estar vacío" : "El asunto no es válido";
        sinError = false;
    } else {
        error[2].textContent = "";
    }

    if(form.mensaje.value.length === 0){
        error[3].textContent = "Este campo no puede estar vacío";
        sinError = false;
    } else {
        error[3].textContent = "";
    }
 
    if (sinError) {
        sendEmail();
        succesForm.textContent="El formulario ha sido enviado correctamente";
        console.log("Formulario enviado correctamente");
    } else {

        errorForm.textContent = "Hay algún error en el formulario";
    }




});

function sendEmail(){
    (function(){
        emailjs.init("5yAeOK7XeA6UGBFaf");
    })();

    var params = {
        nombre: document.querySelector("#nombre").value,
        to: document.querySelector("#to").value,
        asunto: document.querySelector("#asunto").value,
        email: document.querySelector("#email").value,
        mensaje: document.querySelector("#mensaje").value
    };

    var serviceID = "service_jp08u2a";
    var templateID = "template_fuhpfcs";

    emailjs.send(serviceID, templateID, params)
    .then( res => {
        console.log("Email sent successfully!!")
    })
    .catch();
}





