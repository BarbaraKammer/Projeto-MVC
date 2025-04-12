<?php

namespace App\Controller;//Define o namespace da classe.

use App\Entity\Pessoa;//Importa a classe Pessoa (entidade que representa uma pessoa no banco).
use Doctrine\ORM\EntityManager;//Importa o EntityManager, que é o responsável por acessar e modificar os dados no banco de dados.

class PessoaController
{
    private $entityManager;//Cria a classe PessoaController e declara uma variável privada chamada $entityManager, que vai armazenar a instância do gerenciador de entidades (Doctrine).

    //Construtor da classe. Sempre que a classe for usada, o EntityManager será passado e guardado para ser usado nos métodos da classe.
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function listar()
{
    $nome = $_GET['nome'] ?? null;//Pega o valor digitado na busca pelo nome.
    $pessoas = [];//Cria uma lista vazia para armazenar os resultados encontrados.

    if ($nome) {
        $pessoas = $this->entityManager//Se o usuário digitou algo, o sistema faz uma busca no banco pelo nome.
            ->getRepository(\App\Entity\Pessoa::class)//Acessando o repositório( classe responsável por buscar dados no banco) da entidade Pessoa
            ->createQueryBuilder('p')
            ->where('p.nome LIKE :nome')
            ->setParameter('nome', '%' . $nome . '%')//Usa o LIKE '%nome%' para procurar qualquer pessoa que contenha aquele texto no nome.
            ->getQuery()
            ->getResult();
    }

    require __DIR__ . '/../../views/pessoa/listar.php';//Carrega a página que mostra a lista de pessoas (a view com a tabela).
}



public function inserir()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//Verifica se o formulário foi enviado via POST (ou seja, o botão "Salvar" foi clicado).
        // Salva a nova pessoa
        $nome = $_POST['nome'] ?? '';//Pega os dados que o usuário digitou no formulário.
        $cpf = $_POST['cpf'] ?? '';

        $pessoa = new Pessoa();//Cria um novo objeto Pessoa e preenche os dados com os valores recebidos do formulário.
        $pessoa->setNome($nome);
        $pessoa->setCpf($cpf);

        $this->entityManager->persist($pessoa);//persist: Diz ao Doctrine para preparar essa nova pessoa para ser salva.
        $this->entityManager->flush();//flush: Salva de verdade no banco.

        header('Location: ?rota=pessoa_listar');//Depois de salvar, redireciona o usuário para a listagem de pessoas.
        exit;
    }

    // Se for um GET, apenas exibe o formulário vazio para cadastrar uma nova pessoa.
    require __DIR__ . '/../../views/pessoa/formulario.php';
}


    public function editar()
    {
        $id = $_GET['id'] ?? null;//Pega o ID da pessoa passado na URL.
        $pessoa = $this->entityManager->find(Pessoa::class, $id);//Busca essa pessoa no banco.

        if (!$pessoa) {//Se não encontrar a pessoa, mostra erro.
            die("Pessoa não encontrada.");
        }

        require __DIR__ . '/../../views/pessoa/formulario.php';//Se encontrou a pessoa, mostra o formulário já preenchido com os dados dela (para editar).
    }

    public function atualizar()
    {
        $id = $_POST['id'] ?? null;//Pega o ID do formulário e busca a pessoa no banco.
        $pessoa = $this->entityManager->find(Pessoa::class, $id);

        if (!$pessoa) {//Se a pessoa não for encontrada, exibe erro.
            die("Pessoa não encontrada.");
        }

        $pessoa->setNome($_POST['nome']);//Atualiza os dados da pessoa com os novos valores digitados.
        $pessoa->setCpf($_POST['cpf']);

        $this->entityManager->flush();//Salva as alterações no banco.

        header('Location: ?rota=pessoa_listar');//Redireciona para a listagem após atualizar com sucesso.
        exit;
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? null;//Pega o ID da pessoa pela URL e tenta buscá-la no banco.
        $pessoa = $this->entityManager->find(Pessoa::class, $id);

        if (!$pessoa) {//Se não encontrar, exibe erro.
            die("Pessoa não encontrada.");
        }

        $this->entityManager->remove($pessoa);//Remove a pessoa do banco e executa a exclusão.
        $this->entityManager->flush();

        header('Location: ?rota=pessoa_listar');//Depois de excluir, redireciona para a lista de pessoas.
        exit;
    }
}
