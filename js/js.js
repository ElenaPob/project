$("#loginForm").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "backend/login.php",
        data: formData,
        success: function (response) {
            console.log(response);
            location.reload();
            $("#result").html(response);
        }, error: function() {

            $("#result").text("Contraseña o usuario incorrectos.");
            $("#result").css("color","red");

        }
    });
});
