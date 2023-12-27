var form = document.getElementById("formularioInsertar");
var error = document.getElementsByClassName("errorShow");
var errorForm = document.getElementsByClassName("errorForm")[0];

var regexEmail =  /^[^\s@]+@[^\s@]+.[^\s@]+$/;
//Para escribir con espacios
var regexText = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/;
//sin espacios y en minúsculas
var regexRol = /^[a-zñáéíóú]+$/;
//8 caracteres como minimo y 20 como máximo. Sin espacios en blanco.
var regexPassword = /^\S{8,20}$/;

form.emailNuevo.addEventListener("input", function (){
    if(form.emailNuevo.value.length === 0){
        error[0].textContent="Este campo no puede estar vacío";
    }else if(!regexEmail.test(form.emailNuevo.value)){
        error[0].textContent="El email no es válido";
    }else{
        error[0].textContent="";
    }
});
form.nombreNuevo.addEventListener("input", function (){
    if(form.nombreNuevo.value.length === 0){
        error[1].textContent="Este campo no puede estar vacío";
    }else if(!regexText.test(form.nombreNuevo.value)){
        error[1].textContent="El nombre no es válido";
    }else{
        error[1].textContent="";
    }
});
form.apellidoNuevo.addEventListener("input", function (){
    if(form.apellidoNuevo.value.length === 0){
        error[2].textContent="Este campo no puede estar vacío";
    }else if(!regexText.test(form.apellidoNuevo.value)){
        error[2].textContent="El apellido no es válido";
    }else{
        error[2].textContent="";
    }
});
form.estiloNuevo.addEventListener("input", function (){
    if(form.estiloNuevo.value.length === 0){
        error[3].textContent="Este campo no puede estar vacío";
    }else if(!regexText.test(form.estiloNuevo.value)){
        error[3].textContent="El estilo no es válido";
    }else{
        error[3].textContent="";
    }
});
form.descNuevo.addEventListener("input", function (){
    if(form.descNuevo.value.length === 0){
        error[4].textContent="Este campo no puede estar vacío";
    }else{
        error[4].textContent="";
    }
});
form.rolNuevo.addEventListener("input", function (){
    if(form.rolNuevo.value.length === 0){
        error[5].textContent="Este campo no puede estar vacío";
    }else if(!regexRol.test(form.rolNuevo.value)){
        error[5].textContent="El rol debe estar en minúsculas";
    }else{
        error[5].textContent="";
    }
});
form.passwordNueva.addEventListener("input", function (){
    if(form.passwordNueva.value.length === 0){
        error[6].textContent="Este campo no puede estar vacío";
    }else{
        error[6].textContent="";
    }
});


