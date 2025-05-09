# Mercado - Sistema de E-commerce em CodeIgniter 4

Mercado é um sistema de e-commerce completo desenvolvido em CodeIgniter 4, oferecendo uma interface administrativa intuitiva para gerenciamento de produtos e categorias, além de uma loja virtual para os clientes.

## Estado Atual do Projeto

O sistema está em desenvolvimento ativo. Atualmente implementamos:

- ✅ Painel administrativo completo
- ✅ Sistema de gerenciamento de produtos
- ✅ Sistema de gerenciamento de categorias
- ✅ Upload e gerenciamento de imagens
- ✅ Dashboard com estatísticas
- ⏳ Frontend da loja virtual (em desenvolvimento)
- ⏳ Sistema de autenticação de clientes (em desenvolvimento)
- ⏳ Carrinho de compras (em desenvolvimento)
- ⏳ Processamento de pedidos (em desenvolvimento)

## Requisitos do Sistema

- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Extensões PHP: intl, mbstring, json, mysqlnd

## Instalação

1. Clone o repositório
   ```bash
   git clone https://github.com/seu-usuario/mercado.git
   cd mercado
   ```

2. Instale as dependências via Composer
   ```bash
   composer install
   ```

3. Configure o arquivo .env com suas credenciais de banco de dados
   ```
   database.default.hostname = localhost
   database.default.database = mercado_db
   database.default.username = seu_usuario
   database.default.password = sua_senha
   ```

4. Execute as migrações para criar as tabelas no banco de dados
   ```bash
   php spark migrate
   ```

5. Inicie o servidor de desenvolvimento
   ```bash
   php spark serve
   ```

6. Acesse o painel administrativo em http://localhost:8080/admin

## Estrutura do Projeto

- **app/Controllers/Admin** - Controladores do painel administrativo
- **app/Models** - Modelos para operações com o banco de dados
- **app/Views/admin** - Views do painel administrativo
- **public/uploads** - Diretório para armazenamento de imagens
- **docs** - Documentação detalhada do projeto

## Funcionalidades Principais

### Painel Administrativo
- Dashboard com estatísticas e visão geral
- Gerenciamento completo de produtos (CRUD)
- Gerenciamento completo de categorias (CRUD)
- Upload e gerenciamento de múltiplas imagens
- Interface responsiva e traduzida para português

### Produtos
- Cadastro de produtos com múltiplas imagens
- Associação com múltiplas categorias
- Definição de preço normal e promocional
- Marcação de produtos como destaque
- Status ativo/inativo

### Categorias
- Sistema hierárquico (categorias e subcategorias)
- Imagem para cada categoria
- Status ativo/inativo

## Documentação

Documentação detalhada sobre o projeto pode ser encontrada na pasta `docs`:

- [Visão Geral](docs/README.md)
- [Implementação Atual](docs/implementacao_atual.md)

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

## Contato

Para dúvidas ou sugestões, entre em contato através do e-mail: contato@exemplo.com
