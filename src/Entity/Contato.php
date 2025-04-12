<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;//Traz os "recursos" do Doctrine para mapear entidades para tabelas do banco.
use App\Entity\Pessoa;//Indica que essa classe está na pasta Entity dentro da estrutura da aplicação.

#[ORM\Entity]//: Diz que essa classe é uma entidade do Doctrine (vai virar uma tabela no banco).
#[ORM\Table(name: "contato")]// Define o nome da tabela no banco: contato.
class Contato//Declara a classe PHP chamada Contato.
{
    #[ORM\Id]//Define que a propriedade id é a chave primária da tabela.
    #[ORM\GeneratedValue]//O valor do ID será gerado automaticamente (auto-incremento).
    #[ORM\Column(type: "integer")]//O campo será do tipo inteiro.
    private int $id;//Define a variável id, que é privada (só acessada por métodos da classe).

    #[ORM\Column(type: "boolean")]//tipo: Pode ser usado para indicar o tipo de contato (email ou telefone) do tipo booleano (verdadeiro ou falso).
    private bool $tipo;

    #[ORM\Column(type: "string", length: 255)]//descricao: É um texto(string) que descreve o contato com no máximo 255 caracteres.
    private string $descricao;

    #[ORM\ManyToOne(targetEntity: Pessoa::class)]// Define um relacionamento de muitos contatos para uma pessoa (muitos para um = ManyToOne).
    #[ORM\JoinColumn(name: "idPessoa", referencedColumnName: "id", nullable: false)]//idPessoa é o nome da coluna no banco (chave estrangeira). referencedColumnName: "id" indica que ele se relaciona com o campo id da tabela pessoa. nullable: false quer dizer que todo contato deve estar associado a uma pessoa (não pode ser nulo).
    private Pessoa $pessoa;

//Métodos Getters e Setters:  usados para acessar e modificar os valores dos atributos (já que eles são privados).

    public function getId(): int { return $this->id; }//Só tem o getter porque o id é gerado automaticamente.

    public function getTipo(): bool { return $this->tipo; }//getTipo(): Retorna o valor do tipo.
    public function setTipo(bool $tipo): void { $this->tipo = $tipo; }//setTipo(): Define o valor do tipo.

    public function getDescricao(): string { return $this->descricao; }
    public function setDescricao(string $descricao): void { $this->descricao = $descricao; }

    public function getPessoa(): Pessoa { return $this->pessoa; }//getPessoa(): Retorna o objeto da pessoa associada.
    public function setPessoa(Pessoa $pessoa): void { $this->pessoa = $pessoa; }//setPessoa(Pessoa $pessoa): Define qual pessoa está associada ao contato.
}
