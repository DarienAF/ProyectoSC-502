$(document).ready(function () {
    // Al hacer clic en el botón de contacto, se ejecuta esta función.
    $("#contactBtn").click(async function (event) {
        event.preventDefault();

        // Validación de campos
        const fields = ["firstNameMsg", "lastNameMsg", "emailMsg", "titleMsg", "contextMsg"];
        if (!validateForm(fields)) {
            showWarning("Todos los campos deben ser completados.");
            return;
        }

        // Recolecta los datos del formulario y valida cada campo
        const formData = {
            firstNameMsg: $("#firstNameMsg").val().trim(),
            lastNameMsg: $("#lastNameMsg").val().trim(),
            emailMsg: $("#emailMsg").val().trim(),
            titleMsg: $("#titleMsg").val().trim(),
            contextMsg: $("#contextMsg").val().trim()
        };

        // Validación  para el correo electrónico
        if (!validateEmail(formData.emailMsg)) {
            $("#emailMsg").css('border', '1px solid red');
            showError("¡Correo electrónico inválido!");
            return;
        }

        // Realiza una solicitud POST al servidor con los datos del formulario.
        const url = './index.php?controller=ContactPage&action=Contact';
        const result = await performAjaxRequest(url, 'POST', formData);

        // Si la respuesta es exitosa, muestra un mensaje de éxito y limpia los campos.
        if (result.success) {
            showSuccess("Tu mensaje ha sido enviado correctamente. ¡Pronto te contactaremos!")
            $("#firstNameMsg, #lastNameMsg, #emailMsg, #titleMsg, #contextMsg").val('');
        } else {
            // Si hay un error, muestra un mensaje de error.
            showError(result.message);
        }
    });
});
