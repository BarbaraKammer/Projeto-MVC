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
        <input type="text" name="descricao" placeholder="Digite o contato (telefone ou email)" value="<?= htmlspecialchars($_GET['descricao'] ?? '') ?>"><!--name= descricao - O usuário digita o e-mail ou telefone para pesquisar. -->
        <button type="submit">Pesquisar</button><!--htmlspecialchars($_GET['descricao'] ?? '' Se já pesquisou algo, o valor continua no campo ao recarregar -->
    </form>

    <br>

    <!-- Link para cadastrar novo contato  / Primeiro link leva para o cadastro de novo contato. / Segundo link retorna para a página inicial. -->
    <a href="?rota=contato_inserir">Cadastrar Novo Contato</a>
    <br><br>
    <a href="?rota=home.php">Voltar para a página inicial</a>

    <br><br>

    <!-- Tabela de resultados ou mensagens -->
    <?php if (isset($_GET['descricao'])): ?><!--Verifica se foi feito algum envio no campo descricao. -->
        <?php if (!empty($contatos)): ?> <!--Exibe uma tabela com os dados dos contatos encontrados. -->
            <table border="1" cellpadding="8">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Pessoa Pertencente</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($contatos as $contato): ?></table> <!--Percorre a lista de contatos retornada do banco. -->
                    <tr>
                        <td><?= htmlspecialchars($contato->getId()) ?></td><!--ID do contato -->
                        <td><?= $contato->getTipo() ? 'Email' : 'Telefone' ?></td><!--Exibe "Email" se tipo = true (1), ou "Telefone" se tipo = false (0) -->
                        <td>
                        <?php
                            $pessoa = $contato->getPessoa();
                            echo $pessoa ? htmlspecialchars($pessoa->getNome()) : 'Sem pessoa';
                        ?><!--Pega a pessoa associada ao contato. Exibe o nome da pessoa ou "Sem pessoa" se não existir. -->
                        </td>
                        <td><?= htmlspecialchars($contato->getDescricao()) ?></td><!--Exibe a descrição (número de telefone ou email). -->
                        <td>
                            <a href="?rota=contato_editar&id=<?= $contato->getId() ?>">Editar</a> |
                            <a href="?rota=contato_excluir&id=<?= $contato->getId() ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td><!--Link para editar ou excluir o contato. O link de exclusão tem um confirm() do JavaScript, que abre uma caixinha perguntando se o usuário tem certeza.-->
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?><!--Se não houver resultados -->
            <p>Nenhum contato encontrado com essa descrição.</p>
        <?php endif; ?>
    <?php else: ?><!--Se o campo de pesquisa ainda não foi usado -->
        <p>Use o campo acima para pesquisar por descrição.</p>
    <?php endif; ?>
</body>
</html>
