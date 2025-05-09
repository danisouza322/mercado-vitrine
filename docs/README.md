# Documentação do Projeto Mercado

Este diretório contém toda a documentação relacionada ao projeto Mercado, um sistema de e-commerce desenvolvido em CodeIgniter 4.

## Progresso Atual do Projeto

Até o momento, implementamos as seguintes funcionalidades:

1. **Gestão de Produtos**
   - Listagem completa de produtos
   - Adição de novos produtos com upload de múltiplas imagens
   - Edição de produtos existentes
   - Exclusão de produtos
   - Marcação de produtos como "destaque"
   - Gestão de imagens (definir imagem principal, adicionar/remover imagens)

2. **Gestão de Categorias**
   - Listagem de categorias
   - Adição de novas categorias com imagens
   - Edição de categorias existentes
   - Exclusão de categorias (com verificação de segurança para categorias em uso)
   - Suporte a hierarquia de categorias (categoria pai/filha)

3. **Interface Administrativa**
   - Dashboard personalizado com visão geral do sistema
   - Menu lateral simplificado e focado nas funcionalidades atuais
   - Barra superior com busca rápida de produtos
   - Interface traduzida para português
   - Design responsivo e intuitivo

## Estrutura do Banco de Dados

O sistema utiliza as seguintes tabelas principais:

1. **products** - Armazena informações dos produtos
   - Campos: id, name, slug, description, short_description, price, sale_price, sku, stock_status, featured, status, created_at, updated_at

2. **categories** - Armazena informações das categorias
   - Campos: id, name, slug, description, parent_id, image, status, created_at, updated_at

3. **product_categories** - Tabela de relacionamento entre produtos e categorias
   - Campos: product_id, category_id

4. **product_images** - Armazena as imagens dos produtos
   - Campos: id, product_id, image, is_main, created_at

## Próximos Passos

- Implementação da loja virtual (frontend)
- Sistema de usuários e autenticação
- Carrinho de compras
- Processamento de pedidos
- Painel do cliente

## Como Acessar

O painel administrativo pode ser acessado através da URL:
http://localhost:8080/admin

## Documentação Detalhada

Para informações mais detalhadas sobre cada aspecto do sistema, consulte os documentos específicos nesta pasta. 