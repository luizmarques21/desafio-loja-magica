# Desafio Técnico Loja Mágica

## Descrição
A proposta desse desafio é criar uma aplicação simples para gerenciar os clientes e os pedidos de uma loja virtual. A
aplicação possui um CRUD básico e as funcionalidades de importação de dados
via XML e XLSX além de uma tela para envio de mensagens aos clientes.

## Tecnologias usadas
- PHP
- MySQL
- HTML
- CSS
- JavaScript
- JQuery

## Como instalar e rodar o projeto
### Passo 1: Clonar o repositorio

Usando o terminal, navegue até o diretório raiz do seu servidor apache e execute o seguinte comando:

```bash
git clone https://github.com/luizmarques21/desafio-loja-magica.git
```

### Passo 2: Instalar as dependências

Navegue para o repositório do projeto e execute o seguinte comando:

```bash
composer install
```

### Passo 3: Iniciar a database

Usando seu servidor MySQL crie uma nova database e o use o arquivo `database.sql` para criar as tabelas.

### Passo 4: Adicionar as configurações

Adicione as configurações de conexão com o banco MySQL e as configurações de SMTP no arquivo `Infra\config.json`

### Passo 5: Acessar a aplicação

Tendo executado com exito os passos anteriores, já deve ser possível acessar a aplicação usando seu servidor apache. A
base já possui um usuário cadastrado pronto para fazer login.
```
Usuario: admin
Senha: @teste123
```