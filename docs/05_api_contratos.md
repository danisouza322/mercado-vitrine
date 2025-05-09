# API e Contratos

## Visão Geral

Embora o sistema não seja baseado em uma arquitetura de API completa, algumas funcionalidades internas utilizam endpoints de API para comunicação assíncrona. Este documento descreve os contratos e formatos de dados utilizados no sistema.

## Endpoints de API Interna

### Produtos

#### Listar Produtos

**Endpoint**: `GET /api/products`

**Parâmetros de Consulta**:
- `category_id` (opcional): Filtrar por categoria
- `search` (opcional): Termo de busca
- `limit` (opcional): Limite de resultados (padrão: 10)
- `offset` (opcional): Deslocamento para paginação
- `sort` (opcional): Campo para ordenação (padrão: 'id')
- `order` (opcional): Direção da ordenação ('asc' ou 'desc', padrão: 'desc')

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Nome do Produto",
      "slug": "nome-do-produto",
      "short_description": "Descrição breve do produto",
      "price": 99.90,
      "sale_price": null,
      "sku": "PROD001",
      "stock_status": "instock",
      "featured": 1,
      "status": 1,
      "main_image": "/uploads/products/produto-1.jpg",
      "categories": [
        {
          "id": 1,
          "name": "Categoria",
          "slug": "categoria"
        }
      ]
    },
    // ...mais produtos
  ],
  "total": 45,
  "limit": 10,
  "offset": 0
}
```

#### Obter Produto por ID

**Endpoint**: `GET /api/products/{id}`

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "name": "Nome do Produto",
    "slug": "nome-do-produto",
    "description": "Descrição completa do produto",
    "short_description": "Descrição breve do produto",
    "price": 99.90,
    "sale_price": null,
    "sku": "PROD001",
    "stock_status": "instock",
    "featured": 1,
    "status": 1,
    "created_at": "2023-08-15 14:30:00",
    "updated_at": "2023-08-15 14:30:00",
    "images": [
      {
        "id": 1,
        "image": "/uploads/products/produto-1.jpg",
        "is_main": 1
      },
      {
        "id": 2,
        "image": "/uploads/products/produto-1-2.jpg",
        "is_main": 0
      }
    ],
    "categories": [
      {
        "id": 1,
        "name": "Categoria",
        "slug": "categoria"
      }
    ],
    "whatsapp_link": "https://api.whatsapp.com/send?phone=5511999999999&text=Olá!%20Estou%20interessado%20no%20produto:%20Nome%20do%20Produto.%20Poderia%20me%20dar%20mais%20informações?"
  }
}
```

**Resposta de Erro (404 Not Found)**:
```json
{
  "status": "error",
  "message": "Produto não encontrado"
}
```

#### Criar Produto

**Endpoint**: `POST /api/products`

**Headers**:
- `Content-Type: application/json`
- `X-CSRF-TOKEN: {csrf_token}`

**Corpo da Requisição**:
```json
{
  "name": "Novo Produto",
  "description": "Descrição completa do produto",
  "short_description": "Descrição breve",
  "price": 129.90,
  "sale_price": 99.90,
  "sku": "PROD002",
  "stock_status": "instock",
  "featured": 1,
  "status": 1,
  "categories": [1, 3],
  "images": [
    {
      "image": "base64_encoded_image_data",
      "is_main": 1,
      "name": "imagem-principal.jpg"
    }
  ]
}
```

**Resposta de Sucesso (201 Created)**:
```json
{
  "status": "success",
  "message": "Produto criado com sucesso",
  "data": {
    "id": 2,
    "name": "Novo Produto",
    "slug": "novo-produto",
    // ... outros dados do produto
  }
}
```

**Resposta de Erro (400 Bad Request)**:
```json
{
  "status": "error",
  "message": "Erro ao criar produto",
  "errors": {
    "name": "O nome do produto é obrigatório",
    "price": "O preço deve ser maior que zero"
  }
}
```

#### Atualizar Produto

**Endpoint**: `PUT /api/products/{id}`

**Headers**:
- `Content-Type: application/json`
- `X-CSRF-TOKEN: {csrf_token}`

**Corpo da Requisição**: Mesmo formato da criação

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "message": "Produto atualizado com sucesso",
  "data": {
    "id": 2,
    "name": "Produto Atualizado",
    // ... outros dados atualizados
  }
}
```

#### Excluir Produto

**Endpoint**: `DELETE /api/products/{id}`

**Headers**:
- `X-CSRF-TOKEN: {csrf_token}`

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "message": "Produto excluído com sucesso"
}
```

### Categorias

#### Listar Categorias

**Endpoint**: `GET /api/categories`

**Parâmetros de Consulta**:
- `parent_id` (opcional): Filtrar por categoria pai
- `search` (opcional): Termo de busca
- `limit` (opcional): Limite de resultados
- `offset` (opcional): Deslocamento para paginação

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Eletrônicos",
      "slug": "eletronicos",
      "description": "Produtos eletrônicos",
      "parent_id": null,
      "image": "/uploads/categories/eletronicos.jpg",
      "status": 1
    },
    // ...mais categorias
  ],
  "total": 8,
  "limit": 10,
  "offset": 0
}
```

#### Obter Hierarquia de Categorias

**Endpoint**: `GET /api/categories/hierarchy`

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Eletrônicos",
      "slug": "eletronicos",
      "children": [
        {
          "id": 2,
          "name": "Smartphones",
          "slug": "smartphones",
          "children": []
        },
        {
          "id": 3,
          "name": "Notebooks",
          "slug": "notebooks",
          "children": []
        }
      ]
    },
    // ...mais categorias
  ]
}
```

### Upload de Imagens

#### Upload de Imagem de Produto

**Endpoint**: `POST /api/upload/product-image`

**Headers**:
- `Content-Type: multipart/form-data`
- `X-CSRF-TOKEN: {csrf_token}`

**Corpo da Requisição**:
- `image`: Arquivo de imagem
- `product_id` (opcional): ID do produto
- `is_main` (opcional): 1 para definir como imagem principal, 0 caso contrário

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "data": {
    "id": 5,
    "product_id": 2,
    "image": "/uploads/products/produto-2-1.jpg",
    "is_main": 1
  }
}
```

### Configurações

#### Obter Configurações

**Endpoint**: `GET /api/settings`

**Resposta de Sucesso (200 OK)**:
```json
{
  "status": "success",
  "data": {
    "store_name": "Vitrine Online",
    "store_description": "Sua vitrine de produtos online",
    "whatsapp_number": "5511999999999",
    "whatsapp_message": "Olá! Estou interessado no produto: {product_name}. Poderia me dar mais informações?",
    "logo": "/uploads/logo.png",
    "favicon": "/uploads/favicon.ico"
  }
}
```

## Formatos e Contratos

### Produtos

**Estrutura Completa**:
```json
{
  "id": 1,
  "name": "Nome do Produto",
  "slug": "nome-do-produto",
  "description": "Descrição completa do produto...",
  "short_description": "Descrição breve",
  "price": 129.90,
  "sale_price": 99.90,
  "sku": "PROD001",
  "stock_status": "instock",
  "featured": 1,
  "status": 1,
  "created_at": "2023-08-15 14:30:00",
  "updated_at": "2023-08-15 14:30:00",
  "images": [
    {
      "id": 1,
      "image": "/uploads/products/produto-1.jpg",
      "is_main": 1
    }
  ],
  "categories": [
    {
      "id": 1,
      "name": "Categoria",
      "slug": "categoria"
    }
  ],
  "whatsapp_link": "https://api.whatsapp.com/send?phone=5511999999999&text=Olá!%20Estou%20interessado%20no%20produto:%20Nome%20do%20Produto.%20Poderia%20me%20dar%20mais%20informações?"
}
```

### Categorias

**Estrutura Completa**:
```json
{
  "id": 1,
  "name": "Nome da Categoria",
  "slug": "nome-da-categoria",
  "description": "Descrição da categoria",
  "parent_id": null,
  "image": "/uploads/categories/categoria.jpg",
  "status": 1,
  "created_at": "2023-08-15 14:30:00",
  "updated_at": "2023-08-15 14:30:00",
  "products_count": 5
}
```

### Imagens de Produto

**Estrutura Completa**:
```json
{
  "id": 1,
  "product_id": 1,
  "image": "/uploads/products/produto-1.jpg",
  "is_main": 1,
  "created_at": "2023-08-15 14:30:00"
}
```

### Configurações

**Estrutura Completa**:
```json
{
  "id": 1,
  "setting_key": "store_name",
  "setting_value": "Vitrine Online",
  "created_at": "2023-08-15 14:30:00",
  "updated_at": "2023-08-15 14:30:00"
}
```

## Códigos de Status HTTP

- **200 OK**: Requisição bem-sucedida
- **201 Created**: Recurso criado com sucesso
- **400 Bad Request**: Requisição inválida ou mal formada
- **401 Unauthorized**: Autenticação necessária
- **403 Forbidden**: Acesso negado
- **404 Not Found**: Recurso não encontrado
- **500 Internal Server Error**: Erro interno do servidor

## Validações

### Produtos
- `name`: Obrigatório, máximo de 255 caracteres
- `price`: Obrigatório, valor numérico maior que zero
- `categories`: Pelo menos uma categoria deve ser especificada
- `images`: Pelo menos uma imagem deve ser enviada para novos produtos

### Categorias
- `name`: Obrigatório, máximo de 100 caracteres
- `slug`: Único, gerado automaticamente a partir do nome

## Gerando o Link de WhatsApp

O link de WhatsApp é gerado automaticamente para cada produto, seguindo o formato:

```
https://api.whatsapp.com/send?phone={whatsapp_number}&text={mensagem_codificada}
```

Onde `{mensagem_codificada}` é a configuração `whatsapp_message` com o placeholder `{product_name}` substituído pelo nome do produto e codificado para URL. 