<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pessoa) ? 'Editar' : 'Cadastrar' ?> Pessoa</title><!--mostra "Editar Pessoa" se a variável $pessoa estiver definida (ou seja, está editando), senão mostra "Cadastrar Pessoa". -->
</head>
<body>
    <h1><?= isset($pessoa) ? 'Editar' : 'Cadastrar' ?> Pessoa</h1>

    <form method="POST" action="<?= isset($pessoa) ? '?rota=pessoa_atualizar' : '?rota=pessoa_inserir' ?>"><!--Define que os dados do formulário serão enviados por POST. A ação do formulário muda:  Se está editando ($pessoa existe), envia para a rota pessoa_atualizar.  Se está cadastrando, envia para pessoa_inserir.-->
        <?php if (isset($pessoa)): ?><!-- Se $pessoa está definida, o campo oculto envia o id da pessoa para que o sistema saiba qual pessoa atualizar.-->
            <input type="hidden" name="id" value="<?= $pessoa->getId() ?>">
        <?php endif; ?>

        <label for="nome">Nome:</label><!--Campo de texto obrigatório (required) para o nome da pessoa.  Se for edição, o campo já aparece preenchido com o nome da pessoa.-->
        <input type="text" id="nome" name="nome" required value="<?= isset($pessoa) ? htmlspecialchars($pessoa->getNome()) : '' ?>"><br><br>

        <label for="cpf">CPF:</label><!--Campo obrigatório para CPF. -->
        <input type="text" id="cpf" name="cpf" required value="<?= isset($pessoa) ? htmlspecialchars($pessoa->getCpf()) : '' ?>"><br><br>

        <button type="submit">Salvar</button><!--Botão para enviar o formulário. -->
    </form>

    <br>
    <a href="?rota=pessoa_listar">Voltar para a lista</a><!--Link para voltar à lista de pessoas cadastradas (rota=pessoa_listar). -->
</body>
</html>
