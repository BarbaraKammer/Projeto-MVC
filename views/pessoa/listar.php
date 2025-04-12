<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Pessoas</title>
</head>
<body>
    <h1>Pesquisar Pessoas</h1>

    <!-- Formulário de busca -->
    <form method="GET" action=""><!--Começa um formulário com o método GET. Isso significa que os dados da busca irão aparecer na URL.-->
        <input type="hidden" name="rota" value="pessoa_listar"><!--Campo oculto que garante que a página será redirecionada para a rota correta (pessoa_listar) ao pesquisar. -->
        <input type="text" name="nome" placeholder="Digite o nome" value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>"><!--Campo de texto onde o usuário digita o nome para buscar. O value mostra o valor pesquisado anteriormente, se houver, para manter no campo-->
        <button type="submit">Pesquisar</button><!--Botão para enviar o formulário e fazer a busca.-->
    </form>

    <br>

    <!-- Link para cadastrar nova pessoa -->
    <li><a href="?rota=pessoa_inserir">Cadastrar Nova Pessoa</a></li><!--Link para cadastrar uma nova pessoa.-->
    <br>
    <li><a href="?rota=home.php">Voltar a Pagina Inicial</a></li><!--Link para voltar à página inicial.-->

    <br><br>

    <!-- Tabela de resultados ou mensagens -->
    <?php if (isset($_GET['nome'])): ?><!--Verifica se o usuário fez uma busca (ou seja, se o campo "nome" foi enviado na URL). -->
        <?php if (!empty($pessoas)): ?><!--Se houver resultados encontrados (a variável $pessoas não está vazia), mostra a tabela. -->
            <table border="1" cellpadding="8"><!--Define uma tabela com cabeçalhos para ID, Nome, CPF e Ações. -->
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($pessoas as $pessoa): ?> <!--Loop que percorre todas as pessoas encontradas. -->
                    <tr><!--Cada linha exibe os dados da pessoa:-->
                        <td><?= htmlspecialchars($pessoa->getId()) ?></td>
                        <td><?= htmlspecialchars($pessoa->getNome()) ?></td>
                        <td><?= htmlspecialchars($pessoa->getCpf()) ?></td>
                        <td><!--Links para editar ou excluir a pessoa.-->
                            <a href="?rota=pessoa_editar&id=<?= $pessoa->getId() ?>">Editar</a> |
                            <a href="?rota=pessoa_excluir&id=<?= $pessoa->getId() ?>" onclick="return confirm('Tem certeza?')">Excluir</a><!--O botão "Excluir" chama um confirm para evitar exclusões acidentais.-->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?><!--Se não houver resultados -->
            <p>Nenhuma pessoa encontrada com esse nome.</p>
        <?php endif; ?>
    <?php else: ?><!--Se o campo de pesquisa ainda não foi usado -->
        <p>Use o campo acima para pesquisar por nome.</p>
    <?php endif; ?>
</body>
</html>
