# Estrutura do Banco de Dados

## Diagrama Entidade-Relacionamento

```
+----------------+       +-------------------+       +---------------+
|   categories   |       | product_categories|       |   products    |
+----------------+       +-------------------+       +---------------+
| id             |       | product_id        |       | id            |
| name           |       | category_id       |       | name          |
| slug           |<----->+                   |<----->| slug          |
| description    |       +-------------------+       | description   |
| parent_id      |                                   | short_desc    |
| image          |                                   | price         |
| status         |                                   | sale_price    |
| created_at     |       +-------------------+       | sku           |
| updated_at     |       |  product_images   |       | stock_status  |
+----------------+       +-------------------+       | featured      |
                         | id                |       | status        |
                         | product_id        |<------| created_at    |
                         | image             |       | updated_at    |
                         | is_main           |       +---------------+
                         | created_at        |
                         +-------------------+

                         +-------------------+
                         |     settings      |
                         +-------------------+
                         | id                |
                         | setting_key       |
                         | setting_value     |
                         | created_at        |
                         | updated_at        |
                         +-------------------+
```

## Definição das Tabelas

### Tabela `categories`

Armazena as categorias de produtos do sistema.

| Campo | Tipo | Restrições | Descrição |
|-------|------|------------|-----------|
| id | INT | PK, AUTO_INCREMENT | Identificador único da categoria |
| name | VARCHAR(100) | NOT NULL | Nome da categoria |
| slug | VARCHAR(100) | NOT NULL, UNIQUE | Slug para URL amigável |
| description | TEXT | NULL | Descrição da categoria |
| parent_id | INT | NULL, FK -> categories.id | Referência à categoria pai (para subcategorias) |
| image | VARCHAR(255) | NULL | Caminho para a imagem da categoria |
| status | TINYINT | DEFAULT 1 | Status (1=ativo, 0=inativo) |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | Data de criação |
| updated_at | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Data de atualização |

### Tabela `products`

Armazena os produtos do sistema.

| Campo | Tipo | Restrições | Descrição |
|-------|------|------------|-----------|
| id | INT | PK, AUTO_INCREMENT | Identificador único do produto |
| name | VARCHAR(255) | NOT NULL | Nome do produto |
| slug | VARCHAR(255) | NOT NULL, UNIQUE | Slug para URL amigável |
| description | TEXT | NULL | Descrição completa do produto |
| short_description | TEXT | NULL | Descrição curta para listagens |
| price | DECIMAL(10,2) | NOT NULL | Preço original |
| sale_price | DECIMAL(10,2) | NULL | Preço promocional (se houver) |
| sku | VARCHAR(100) | NULL | Código de referência do produto |
| stock_status | ENUM('instock', 'outofstock') | DEFAULT 'instock' | Status do estoque |
| featured | TINYINT | DEFAULT 0 | Destaque na home (1=sim, 0=não) |
| status | TINYINT | DEFAULT 1 | Status (1=ativo, 0=inativo) |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | Data de criação |
| updated_at | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Data de atualização |

### Tabela `product_categories`

Tabela de relacionamento entre produtos e categorias (muitos para muitos).

| Campo | Tipo | Restrições | Descrição |
|-------|------|------------|-----------|
| product_id | INT | PK, FK -> products.id | Referência ao produto |
| category_id | INT | PK, FK -> categories.id | Referência à categoria |

### Tabela `product_images`

Armazena as imagens associadas aos produtos.

| Campo | Tipo | Restrições | Descrição |
|-------|------|------------|-----------|
| id | INT | PK, AUTO_INCREMENT | Identificador único da imagem |
| product_id | INT | NOT NULL, FK -> products.id | Referência ao produto |
| image | VARCHAR(255) | NOT NULL | Caminho para a imagem |
| is_main | TINYINT | DEFAULT 0 | Indica se é a imagem principal (1=sim, 0=não) |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | Data de criação |

### Tabela `settings`

Armazena as configurações gerais do sistema.

| Campo | Tipo | Restrições | Descrição |
|-------|------|------------|-----------|
| id | INT | PK, AUTO_INCREMENT | Identificador único da configuração |
| setting_key | VARCHAR(100) | NOT NULL, UNIQUE | Chave da configuração |
| setting_value | TEXT | NULL | Valor da configuração |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | Data de criação |
| updated_at | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Data de atualização |

## Configurações Iniciais do Banco

### Valores Iniciais para `settings`

| setting_key | setting_value | Descrição |
|-------------|---------------|-----------|
| store_name | "Vitrine Online" | Nome da loja |
| store_description | "Sua vitrine de produtos online" | Descrição da loja |
| whatsapp_number | "5511999999999" | Número do WhatsApp para contato |
| whatsapp_message | "Olá! Estou interessado no produto: {product_name}. Poderia me dar mais informações?" | Modelo de mensagem para WhatsApp |
| logo | "logo.png" | Logo da loja |
| favicon | "favicon.ico" | Favicon do site |
| meta_title | "Vitrine Online - Produtos de Qualidade" | Título meta para SEO |
| meta_description | "Confira nossos produtos de qualidade e entre em contato via WhatsApp" | Descrição meta para SEO |
| currency_symbol | "R$" | Símbolo da moeda |
| currency_code | "BRL" | Código da moeda |

## Migrações

As migrações serão implementadas utilizando o sistema nativo de migrações do CodeIgniter 4, permitindo controle de versão do banco de dados e fácil implantação.

Exemplo de migração para a tabela `categories`:

```php
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'parent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('parent_id', 'categories', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
``` 