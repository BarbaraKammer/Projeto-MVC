<?php
// Carrega automaticamente todas as bibliotecas e arquivos configurados com o Composer.
// Inclui o Doctrine e outras dependências do projeto.
require_once __DIR__ . '/../vendor/autoload.php';
// Carrega a configuração do Doctrine (conexão com o banco, entidades, etc.)
require_once __DIR__ . '/../config/bootstrap.php';

// Usa (importa) as classes dos controladores de Pessoa e Contato.
use App\Controller\PessoaController;
use App\Controller\ContatoController;

// Verifica se existe o parâmetro 'rota' na URL. Exemplo: ?rota=pessoa_listar
// Se existir, guarda esse valor na variável $rota. Se não existir, $rota será uma string vazia.
$rota = $_GET['rota'] ?? '';

switch ($rota) {//Aqui começa o sistema de rotas, que decide o que fazer baseado na URL
    // Rotas de Pessoa
    case 'pessoa_listar':
        $controller = new PessoaController($entityManager);//Cria um novo objeto da classe PessoaController, passando o $entityManager como parâmetro, que é o que permite que o controller se comunique com o banco de dados usando o Doctrine.
        $controller->listar();//Chama o método listar() que está dentro do objeto da classe PessoaController.
        break;

    case 'pessoa_inserir':
        $controller = new PessoaController($entityManager);
        $controller->inserir();
        break;

    case 'pessoa_editar':
        $controller = new PessoaController($entityManager);
        $controller->editar();
        break;

    case 'pessoa_atualizar':
        $controller = new PessoaController($entityManager);
        $controller->atualizar();
        break;

    case 'pessoa_excluir':
        $controller = new PessoaController($entityManager);
        $controller->excluir();
        break;

    // Rotas de Contato
    case 'contato_listar':
        $controller = new ContatoController($entityManager);
        $controller->listar();
        break;

    case 'contato_inserir':
        $controller = new ContatoController($entityManager);
        $controller->inserir();
        break;

    case 'contato_editar':
        $controller = new ContatoController($entityManager);
        $controller->editar();
        break;

    case 'contato_atualizar':
        $controller = new ContatoController($entityManager);
        $controller->atualizar();
        break;

    case 'contato_excluir':
        $controller = new ContatoController($entityManager);
        $controller->excluir();
        break;

    // Se a rota não for reconhecida, carrega a página inicial (home.php)
    default:
        include __DIR__ . '/../views/home.php';
        break;
}
