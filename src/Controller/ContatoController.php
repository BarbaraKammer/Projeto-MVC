<?php

namespace App\Controller;

use App\Entity\Contato;//Importa a classe Contato, que é a entidade que representa os contatos do banco de dados.
use Doctrine\ORM\EntityManager;//Importa o EntityManager, que é o principal objeto do Doctrine para acessar o banco de dados (buscar, inserir, atualizar, deletar...).

class ContatoController//Cria a classe que vai controlar tudo que é relacionado a contato.

{
    private $entityManager;//Cria uma variável interna da classe para armazenar o EntityManager. A gente usa isso dentro de cada função para acessar o banco.

    public function __construct(EntityManager $entityManager)//Método chamado automaticamente quando o controller for usado
    {
        $this->entityManager = $entityManager;//Guarda o objeto recebido para usar nos outros métodos (listar, inserir, etc)
    }

    public function listar()
    {
        $descricao = $_GET['descricao'] ?? null;//Pega o valor digitado no campo de busca (descricao). Se não foi enviado nada, o valor fica null.
        $contatos = [];// cria a variável que vai guardar os contatos encontrados (começa vazia).

        if ($descricao) {//Esse if verifica: tem algum valor na descrição? Se tiver, ele entra e faz a busca no banco de dados com esse filtro, se nao, nem entra nesse bloco
            $contatos = $this->entityManager//$this->entityManager é o objeto que fala com o banco de dados (Doctrine). Iniciando a construção da busca com ele.
                ->getRepository(Contato::class)//O getRepository() permite que a gente busque dados dessa entidade
                ->createQueryBuilder('c')//monta a consulta no banco de forma dinâmica, filtrando por LIKE.
                ->where('c.descricao LIKE :descricao')
                ->setParameter('descricao', '%' . $descricao . '%')//'%'.$descricao.'%': isso permite buscar textos que contenham a palavra digitada.
                ->getQuery()//Esse método finaliza a construção da consulta (query builder) e a transforma em uma query pronta para ser executada.
                ->getResult();//Depois de chamar getQuery(), usa getResult() para executar a query no banco e pegar os resultados como um array de objetos.
        }

        require __DIR__ . '/../../views/contato/listar.php';//require ... listar.php: carrega a tela de listagem, que vai mostrar os contatos na tabela.
    }

    public function inserir()
{//Verifica se o formulário foi enviado via método POST (ou seja, se o usuário clicou no botão "Cadastrar").
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//Pega os valores enviados pelo formulário:
        $tipo = $_POST['tipo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $idPessoa = $_POST['idPessoa'];

        $pessoa = $this->entityManager->find(\App\Entity\Pessoa::class, $idPessoa);//Busca no banco de dados a pessoa correspondente ao ID informado.

        if ($pessoa) {//Só continua o cadastro se uma pessoa com esse ID foi encontrada.
            $contato = new Contato();//Cria um novo objeto Contato e define os dados nele, associando à pessoa encontrada.
            $contato->setTipo($tipo);
            $contato->setDescricao($descricao);
            $contato->setPessoa($pessoa);

            $this->entityManager->persist($contato);//persist(): diz ao Doctrine que esse contato será salvo.
            $this->entityManager->flush();//flush(): executa no banco a operação de salvar.

            header('Location: ?rota=contato_listar');//Depois de salvar, redireciona para a tela de listagem de contatos.
            exit;
        } else {//Se a pessoa não existir, salva a mensagem de erro (usada depois na view).
            $erro = "Pessoa não encontrada.";
        }
    }
    
    require __DIR__ . '/../../views/contato/formulario.php';//Se for GET (ou se houve erro), mostra o formulário na tela.
}
    

    public function editar()
    {
        $id = $_GET['id'] ?? null;//Pega o ID do contato que foi passado na URL (ex: ?rota=contato_editar&id=3) Se não vier nada, o valor será null.
        $contato = $this->entityManager->find(Contato::class, $id);//Busca no banco de dados o contato com o ID informado. Se existir, ele retorna um objeto do tipo Contato.

        if (!$contato) {//Se não encontrar o contato no banco, exibe uma mensagem de erro e para tudo com die().
            die("Contato não encontrado.");
        }

        require __DIR__ . '/../../views/contato/formulario.php';//Se encontrou o contato, carrega a view do formulário, agora preenchida com os dados para edição.
    }

    public function atualizar()
    {
        $id = $_POST['id'] ?? null;//Pega o ID do contato que foi enviado no formulário de edição. Se não vier nada, o valor será null.
        $contato = $this->entityManager->find(Contato::class, $id);//Busca no banco de dados o contato com o ID informado. Se encontrar, retorna o objeto Contato correspondente.

        if (!$contato) {//Se o contato não for encontrado, para tudo e mostra uma mensagem de erro.
            die("Contato não encontrado.");
        }
        //Atualiza os valores do tipo (telefone ou e-mail) e da descrição com os dados enviados no formulário.
        $contato->setTipo($_POST['tipo']);
        $contato->setDescricao($_POST['descricao']);

        // NOVO: atualiza a pessoa relacionada
        $idPessoa = $_POST['idPessoa'];//Busca no banco a Pessoa relacionada ao contato (com base no ID da pessoa enviado no formulário). É usada para garantir que a pessoa ainda existe.
        $pessoa = $this->entityManager->find(\App\Entity\Pessoa::class, $idPessoa);

        if (!$pessoa) {//Se não encontrar essa pessoa, exibe erro e interrompe o processo.
            die("Pessoa vinculada não encontrada.");
        }

        $contato->setPessoa($pessoa);//Associa a nova pessoa encontrada ao contato (caso o ID tenha sido alterado no formulário).

        $this->entityManager->flush();//Salva todas as alterações no banco de dados de uma vez.

        header('Location: ?rota=contato_listar');//Depois de atualizar com sucesso, redireciona o usuário para a página de lista de contatos.
        exit;
    }


    public function excluir()
    {
        $id = $_GET['id'] ?? null;//Pega o ID do contato passado pela URL (usando $_GET). Se não vier nada, define como null.

        $contato = $this->entityManager->find(Contato::class, $id);//Busca no banco de dados o contato com o ID informado. Se encontrar, ele traz o objeto Contato.

        if (!$contato) {//Se não encontrar nenhum contato com aquele ID, o sistema exibe uma mensagem de erro e para o script.
            die("Contato não encontrado.");
        }

        $this->entityManager->remove($contato);//Pede para o Doctrine remover o contato do banco de dados.
        $this->entityManager->flush();//Aplica a alteração de fato no banco (executa o delete).

        header('Location: ?rota=contato_listar');//Depois de excluir com sucesso, redireciona o usuário de volta para a lista de contatos.
        exit;
    }

}