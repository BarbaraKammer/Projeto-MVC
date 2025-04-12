<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= isset($contato) ? 'Editar' : 'Cadastrar' ?> Contato</title><!-- isset($contato) verifica se a variável $contato existe. Se sim: mostra "Editar Contato" Se não: mostra "Cadastrar Contato" -->
</head>
<body>
    <?php if (!empty($erro)): ?><!--Verifica se a variável $erro não está vazia. Se houver um erro, exibe a mensagem em vermelho. -->
        <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <h1><?= isset($contato) ? 'Editar' : 'Cadastrar Novo' ?> Contato</h1><!--Mostra o título grande da página. "Editar Contato" se estiver editando "Cadastrar Novo Contato" se for novo -->

    <form method="POST" action="?rota=<?= isset($contato) ? 'contato_atualizar' : 'contato_inserir' ?>"> <!--method="POST": os dados do formulário serão enviados via POST. action="?rota=...": define a rota do backend para tratar os dados: contato_inserir se for cadastro contato_atualizar se for edição -->
        <?php if (isset($contato)): ?><!--Esse campo só aparece no modo de edição. -->
            <input type="hidden" name="id" value="<?= $contato->getId() ?>"><!--Ele envia o id do contato para que o backend saiba qual contato atualizar. -->
        <?php endif; ?>

        <!-- Tipo -->
        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required><!--Permite escolher o tipo do contato: Telefone ou E-mail. Se estiver editando, o tipo correspondente vem selecionado com selected. -->
            <option value="0" <?= (isset($contato) && !$contato->getTipo()) ? 'selected' : '' ?>>Telefone</option>
            <option value="1" <?= (isset($contato) && $contato->getTipo()) ? 'selected' : '' ?>>E-mail</option>
        </select>
        <br><br>

        <!-- Descrição / campo de texto para digitar a descrição do contato:-->
        <label for="descricao">Descrição:</label><!--Se estiver editando, o campo já aparece preenchido com a descrição atual. -->
        <input type="text" id="descricao" name="descricao" required
            value="<?= isset($contato) ? htmlspecialchars($contato->getDescricao()) : '' ?>">
        <br><br>

        <!-- ID da Pessoa relacionada -->
        <label for="idPessoa">ID da Pessoa:</label>
        <input type="number" name="idPessoa" id="idPessoa" required 
            value="<?= isset($contato) ? $contato->getPessoa()->getId() : '' ?>"><!-- Campo numérico para indicar qual pessoa está ligada a esse contato. -->
        <br>

        <!-- Exibe nome da pessoa relacionada se estiver editando -->
        <?php if (isset($contato)): ?>
            <p><strong>Nome da Pessoa:</strong> <?= htmlspecialchars($contato->getPessoa()->getNome()) ?></p>
        <?php endif; ?>

        <br>
        <!--Botão que envia o formulário. -->
        <button type="submit"><?= isset($contato) ? 'Atualizar' : 'Cadastrar' ?></button>
    </form>

    <br>
    <a href="?rota=contato_listar">Voltar para lista de contatos</a><!--Um link simples para voltar à página que lista todos os contatos cadastrados.-->
</body>
</html>
