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
        alert("Email sent successfully!!")
    })
    .catch();
}


