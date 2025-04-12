<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Contatos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Sistema de Gerenciamento</h1>
    <p>Escolha uma opção:</p>

    <div class="botoes-container">
    <a href="?rota=pessoa_listar" class="botao-link" onclick="mostrarAlerta()">Gerenciar Pessoas</a>
    <a href="?rota=contato_listar" class="botao-link" onclick="mostrarAlerta()">Gerenciar Contatos</a>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
<!--<a href="?rota=pessoa_listar" ...>: Um link que leva para a listagem de pessoas do sistema. Usa o sistema de rotas passando pessoa_listar.

class="botao-link": Aplica o estilo de botão definido no CSS.

onclick="mostrarAlerta()": Chama uma função JavaScript chamada mostrarAlerta() ao clicar. -->