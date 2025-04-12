<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Contatos</title>
</head>
<body>
    <h1>Pesquisar Contatos</h1>

    <!-- Formulário de busca -->
    <form method="GET" action="">
        <input type="hidden" name="rota" value="contato_listar">
        <input type="text" name="descricao" placeholder="Digite o contato (telefone ou email)" value="<?= htmlspecialchars($_GET['descricao'] ?? '') ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <br>

    <!-- Links -->
    <a href="?rota=contato_inserir">Cadastrar Novo Contato</a>
    <br><br>
    <a href="?rota=home.php">Voltar para a página inicial</a>

    <br><br>

    <!-- Tabela de resultados ou mensagens -->
    <?php if (isset($_GET['descricao'])): ?>
        <?php if (!empty($contatos)): ?>
            <table border="1" cellpadding="8">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Pessoa Pertencente</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?= htmlspecialchars($contato->getId()) ?></td>
                        <td><?= $contato->getTipo() ? 'Email' : 'Telefone' ?></td>
                        <td>
                            <?php
                                $pessoa = $contato->getPessoa();
                                echo $pessoa ? htmlspecialchars($pessoa->getNome()) : 'Sem pessoa';
                            ?>
                        </td>
                        <td><?= htmlspecialchars($contato->getDescricao()) ?></td>
                        <td>
                            <a href="?rota=contato_editar&id=<?= $contato->getId() ?>">Editar</a> |
                            <a href="?rota=contato_excluir&id=<?= $contato->getId() ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Nenhum contato encontrado com essa descrição.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Use o campo acima para pesquisar por descrição.</p>
    <?php endif; ?>
</body>
</html>
