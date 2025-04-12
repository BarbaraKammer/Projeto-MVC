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

# Docker deve ser devidamente instalado e iniciado.

Abra o terminal do Git Bash e execute os comandos abaixo:

```bash
# Clonar o repositório
git clone https://github.com/BarbaraKammer/Projeto-MVC.git

# Entrar na pasta do projeto
cd Projeto-MVC

# Instalar dependencias PHP
docker run --rm -v "/$(pwd -W):/app" -w //app composer install --ignore-platform-reqs

# Subir os containers com Docker
docker-compose up -d

## A aplicação estará disponível em: http://localhost:8080
