# Mercado Vitrine

Vitrine online para exibição de produtos com funcionalidade de contato direto via WhatsApp, substituindo o tradicional sistema de carrinho de compras e checkout.

## Sobre o Projeto

Este projeto é uma aplicação web desenvolvida com CodeIgniter 4 que oferece uma vitrine de produtos online com foco na simplicidade e eficiência. Em vez de implementar um sistema completo de e-commerce com carrinho de compras, checkout e pagamentos, a aplicação conecta diretamente os clientes aos vendedores via WhatsApp.

### Funcionalidades Principais

#### Vitrine Online (Frontend)
- Exibição de produtos organizados por categorias
- Página de detalhes do produto com descrição completa
- Botão de contato WhatsApp em cada produto
- Listagem de produtos por categoria
- Busca de produtos
- Exibição de produtos em destaque

#### Painel Administrativo (Backend)
- Autenticação segura com CodeIgniter Shield
- Gestão completa de produtos (CRUD)
- Gestão de categorias (CRUD)
- Upload e gerenciamento de imagens de produtos
- Dashboard com estatísticas básicas

## Tecnologias Utilizadas

- **Backend**: PHP 8.x, CodeIgniter 4
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Template**: Nest eCommerce (Admin e Frontend)
- **Banco de Dados**: MySQL
- **Autenticação**: CodeIgniter Shield
- **Versionamento**: Git

## Pré-requisitos

- PHP 8.1 ou superior
- MySQL/MariaDB
- Composer
- Node.js e NPM (para assets frontend)

## Instalação

1. Clone o repositório
   ```
   git clone https://github.com/danisouza322/mercado-vitrine.git
   ```

2. Instale as dependências PHP
   ```
   composer install
   ```

3. Configure o arquivo .env
   ```
   cp env .env
   ```
   Edite o arquivo .env com suas configurações de banco de dados

4. Execute as migrações e seeders
   ```
   php spark migrate
   php spark db:seed DatabaseSeeder
   ```

5. Inicie o servidor
   ```
   php spark serve
   ```

6. Acesse o sistema em `http://localhost:8080`

## Licença

Este projeto está licenciado sob a licença MIT.