<?php
// classes da biblioteca Doctrine
use Doctrine\ORM\ORMSetup;//Classe que configura o Doctrine
use Doctrine\ORM\EntityManager;//: É o "gerente" das entidades. Ele faz tudo: salvar, buscar, atualizar e remover dados.
use Doctrine\DBAL\DriverManager;//É responsável por configurar a conexão com o banco de dados.

require_once dirname(__DIR__) . '/vendor/autoload.php'; // require_once carrega todas as dependências do Composer, como o Doctrine.
//dirname(__DIR__) pega o caminho da pasta anterior (volta um nível). Então ele está puxando o vendor/autoload.php, que o Composer cria quando você instala uma biblioteca.


// Configuração do Doctrine
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . "/../src/Entity"], // Pasta onde as entidades estão localizadas
    isDevMode: true// se está em modo desenvolvedor. Coloca como true para mostrar mais mensagens de erro e atualizar os metadados automaticamente.
);

// Configuração do banco de dados
$connectionParams = [
    'dbname'   => 'meus_contatos',//Nome do banco de dados.
    'user'     => 'root',//Nome do usuário do banco
    'password' => 'root',//Senha
    'host'     => 'mysql',//Onde o banco está rodando
    'driver'   => 'pdo_mysql',//O tipo de banco — aqui é MySQL usando PDO(interface do PHP que permite conectar e interagir com diferentes tipos de banco de dados)
    'charset'  => 'utf8mb4'//Padrão de caracteres — utf8mb4 suporta acentos e emojis
];

// Criando o EntityManager
$entityManager = new EntityManager(
    DriverManager::getConnection($connectionParams, $config), //Junta a conexão com o banco com a configuração do mapeamento das entidades.
    $config//Depois disso, o $entityManager está pronto para ser usado para: Buscar registros do banco; Inserir novos dados; Atualizar; Remover.
);

