<!DOCTYPE html>
<html>
<head>
    <title>Página Principal</title>
    <style>
        /* Estilo do modal */
        .modal {
            display: none; /* Oculto por padrão */
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6); /* Fundo escuro */
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 70%;
            max-height: 80%;
            overflow-y: auto;
            box-shadow: 0 0 10px #000;
        }

        .close {
            float: right;
            font-size: 22px;
            font-weight: bold;
            cursor: pointer;
        }

        iframe {
            width: 100%;
            height: 400px;
            border: none;
        }
    </style>
</head>
<body>

    <h1>Página Principal</h1>
    <button onclick="abrirModal()">Abrir Pop-up Interno</button>

    <!-- Modal -->
    <div id="meuModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <iframe src="popup.php"></iframe> <!-- Carrega outro arquivo -->
        </div>
    </div>

    <script>
        function abrirModal() {
            document.getElementById("meuModal").style.display = "block";
        }

        function fecharModal() {
            document.getElementById("meuModal").style.display = "none";
        }

        // Fecha o modal clicando fora da área de conteúdo
        window.onclick = function(event) {
            let modal = document.getElementById("meuModal");
            if (event.target == modal) {
                fecharModal();
            }
        }
    </script>

</body>
</html>
