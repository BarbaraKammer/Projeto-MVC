<?php
namespace App\Entity;//Indica que essa classe está na pasta Entity dentro da estrutura da aplicação.

use Doctrine\ORM\Mapping as ORM;//Importa os recursos de anotação do Doctrine para mapear a classe e seus atributos com o banco de dados.

#[ORM\Entity]// Diz ao Doctrine que essa classe representa uma entidade, ou seja, uma tabela no banco de dados.
#[ORM\Table(name: "pessoa")]// Diz que o nome da tabela no banco será pessoa.
class Pessoa
{
    #[ORM\Id]//Define que id é a chave primária da tabela.
    #[ORM\GeneratedValue]//O valor do ID será gerado automaticamente (auto-incremento).
    #[ORM\Column(type: "integer")]// Campo do tipo inteiro.
    private int $id;// Atributo privado que armazena o ID da pessoa.

    #[ORM\Column(type: "string", length: 255)]
    private string $nome;

    #[ORM\Column(type: "string", length: 14, unique: true)]//unique: true: Garante que não pode haver duas pessoas com o mesmo CPF no banco de dados.
    private string $cpf;
//Métodos Getters e Setters: permitem acessar (get) ou modificar (set) os dados dos atributos, já que eles são private.
    public function getId(): int { return $this->id; }//Só tem getId() porque o ID é gerado automaticamente pelo banco.
    public function getNome(): string { return $this->nome; }
    public function setNome(string $nome): void { $this->nome = $nome; }

    public function getCpf(): string { return $this->cpf; }//getCpf(): Retorna o CPF.
    public function setCpf(string $cpf): void { $this->cpf = $cpf; }//setCpf(): Define ou atualiza o CPF da pessoa.
}


