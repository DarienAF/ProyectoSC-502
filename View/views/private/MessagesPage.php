<!DOCTYPE html>
<html>
<?php require './View/fragments/head_private.php'; ?>

<body>
<?php require './View/fragments/nav_private.php'; ?>

<div class="content bootdey">
    <div class="email-app mb-4">
        <nav>
            <h1>Inbox</h1>
            <ul class="nav">
                <li class="nav-item">
                    <button class="nav-link" id="inboxBtn"><i class="bi bi-inbox-fill"></i> Inbox</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="sentBtn"><i class="bi bi-send-check-fill"></i> Enviados</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="archiveBtn"><i class="bi bi-archive-fill"></i> Archivo</button>
                </li>
            </ul>
        </nav>
        <main class="inbox">
            <ul class="messages">
            </ul>
        </main>
    </div>
</div>


<!--Modal-->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Complete Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="email-app mb-4">
                        <main class="message">
                            <div class="details">
                                <div class="title" id="modalTitle"></div>
                                <div class="header">
                                    <div class="from">
                                        <span id="modalFrom">Nombre</span>
                                    </div>
                                    <div class="date" id="modalDate"></div>
                                </div>
                                <div class="message-container">
                                    <p id="modalContent">
                                    </p>
                                </div>
                                <form id="replyForm">
                                    <div class="form-group">
                                        <textarea class="form-control" id="replyMessage" rows="12"
                                                  placeholder="Escribe tu respuesta aquí..."></textarea>
                                    </div>
                                    <div class="form-group text-center pt-2">
                                        <button id="sendReply" type="button" class="btn btn-success">Responder</button>
                                        <button id="closeMessage" type="button" class="btn btn-light">Cerrar</button>
                                        <button id="archiveMessage" type="button" class="btn btn-danger">Archivar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './View/fragments/footer.php'; ?>
<script src="./View/js/crudMensajes/messagespage.js"></script>
</body>
</html>