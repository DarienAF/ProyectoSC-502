$(document).ready(function () {
    var inboxActive;
    var openId;

    $('#inboxBtn').click(function () {
        loadMessages('recibido');
    });
    $('#sentBtn').click(function () {
        loadMessages('enviado');
    });
    $('#archiveBtn').click(function () {
        loadMessages('archivado');
    });
    $("#sendReply").click(function () {
        sendReply();
    });
    $("#closeMessage").click(function () {
        closeModal();
    })
    $("#archiveMessage").click(function () {
        archiveMessage();
    });

    async function loadMessages(estado) {
        try {
            console.log(estado);
            const url = `./index.php?controller=MessagesPage&action=getMessages&estado=${estado}`;
            const response = await fetch(url, {
                method: 'GET'
            });
            if (!response.ok) {
                throw new Error('Error al realizar el fetch ' + response.statusText);
            }
            const messages = await response.json();
            displayMessages(messages);
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function displayMessages(messages) {
        var messagesList = $('.messages');
        messagesList.empty();

        messages.forEach(function (message) {
            var messageClass = message.leido == 0 ? 'unread' : '';
            var messageElement = `
                <li class="message ${messageClass}" data-message='${JSON.stringify(message)}'>
                    <a href="#" class="message-link">
                        <div class="actions">
                            <span class="action"><i class="fa fa-square-o"></i></span>
                        </div>
                        <div class="header">
                            <span class="from">${message.nombre}</span>
                            <span class="date">${new Date(message.fecha).toLocaleString()}</span>
                        </div>
                        <div class="title">${message.titulo}</div>
                        <div class="description">${message.contexto}</div>
                    </a>
                </li>
            `;
            messagesList.append(messageElement);
        });

        $('.message-link').click(function (e) {
            e.preventDefault();
            var message = $(this).closest('.message').data('message');
            loadMessageIntoModal(message);
        });
    }

    async function loadMessageIntoModal(message) {
        $('#modalTitle').text(message.titulo);
        $('#modalFrom').text("De: " + message.nombre + " <" + message.correo + ">");
        $('#modalDate').text(new Date(message.fecha).toLocaleString());
        $('#modalContent').text(message.contexto);
        openId = message.id;

        if (message.estado === "enviado") {
            $('#sendReply').addClass('hidden');
            $('#replyMessage').addClass('hidden');
        } else if (message.estado === "archivado") {
            $('#sendReply').addClass('hidden');
            $('#archiveMessage').addClass('hidden');
            $('#replyMessage').addClass('hidden');
        } else {
            $('#sendReply').removeClass('hidden');
            $('#archiveMessage').removeClass('hidden');
            $('#replyMessage').removeClass('hidden');
        }

        try {
            await markMessageAsRead(openId);
        } catch (error) {
            console.error('Error marcando el mensaje como leído:', error);
        }

        $('#messageModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        inboxActive = message.estado;

        $('#messageModal').modal('show');
    }

    async function markMessageAsRead(idMensaje) {
        const url = './index.php?controller=MessagesPage&action=setMensajeLeido';
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({idMensaje: idMensaje})
        });

        if (!response.ok) {
            throw new Error('Falló la solicitud para marcar mensaje como leído');
        }

        const result = await response.json();

        if (!result.success) {
            throw new Error(result.message || 'Error desconocido');
        }
    }

    async function sendReply() {
        if (!$("#replyMessage").val().trim()) {
            showWarning("El mensaje no puede estar vacío.");
            return;
        }
        const formData = {
            titleMsg: $("#modalTitle").text().trim(),
            contextMsg: $("#replyMessage").val()
        };

        // Realiza una solicitud POST al servidor.
        const url = './index.php?controller=MessagesPage&action=reply';
        const result = await performAjaxRequest(url, 'POST', formData);

        if (result.success) {
            showSuccess("Mensaje respondido con éxito.")
            closeModal();
        } else {
            showError(result.message);
        }
    }

    async function archiveMessage() {
        const url = './index.php?controller=MessagesPage&action=archivarMensaje';
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({idMensaje: openId})
        });

        if (!response.ok) {
            throw new Error('Falló la solicitud para archivar mensaje');
        }

        const result = await response.json();

        if (result.success) {
            showSuccess("Mensaje archivado con éxito.")
            closeModal();
        } else {
            showError(result.message);
        }
    }

    function closeModal() {
        loadMessages(inboxActive);
        $('#messageModal').modal('hide');
    }

    loadMessages('recibido');
});
