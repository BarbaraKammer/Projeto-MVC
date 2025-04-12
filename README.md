# MY PHP APP

Aplicação PHP baseada no padrão MVC com Composer, Doctrine ORM e Docker.  
O sistema permite realizar cadastro, listagem e gerenciamento de pessoas e seus respectivos contatos.  

## Tecnologias Utilizadas

- PHP 8+
- Composer
- Doctrine ORM
- MySQL
- Docker e Docker Compose
- HTML, CSS e JavaScript

## Como Rodar o Projeto com Docker

Para rodar esta aplicação, você precisa ter os seguintes programas instalados na sua máquina:

- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)


Abra o terminal e execute os comandos abaixo:

```bash
# Clonar o repositório
git clone https://github.com/BarbaraKammer/web.git

# Entrar na pasta do projeto
cd web

# Subir os containers com Docker
docker-compose up -d

## A aplicação estará disponível em: http://localhost:8080