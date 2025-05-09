# Estratégia de Testes

Este documento descreve a estratégia de testes para garantir a qualidade do sistema de Vitrine Online.

## Visão Geral

Uma estratégia de testes adequada é essencial para garantir a qualidade, confiabilidade e segurança do sistema. O projeto adota uma abordagem de testes em múltiplos níveis, abrangendo desde testes unitários até testes de aceitação.

## Tipos de Testes

### Testes Unitários

Os testes unitários verificam o correto funcionamento de componentes individuais do sistema.

#### Frameworks/Ferramentas:
- PHPUnit (integrado ao CodeIgniter 4)

#### Componentes a serem testados:
- Models
- Services
- Helpers
- Entities

#### Exemplos:

**Teste do CategoryModel**:
```php
<?php

namespace Tests\Models;

use App\Models\CategoryModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class CategoryModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $seed = 'Tests\Seeds\CategorySeeder';
    protected $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new CategoryModel();
    }

    public function testFindAll()
    {
        $categories = $this->model->findAll();
        $this->assertIsArray($categories);
        $this->assertGreaterThan(0, count($categories));
    }

    public function testCreateCategory()
    {
        $data = [
            'name' => 'Test Category',
            'description' => 'This is a test category',
            'status' => 1
        ];

        $result = $this->model->insert($data);
        $this->assertIsNumeric($result);
        $this->assertGreaterThan(0, $result);

        $category = $this->model->find($result);
        $this->assertEquals('Test Category', $category['name']);
        $this->assertEquals('test-category', $category['slug']);
    }

    public function testUpdateCategory()
    {
        $data = [
            'name' => 'Updated Category',
            'description' => 'This is an updated category',
        ];

        $id = 1; // Assumindo que existe uma categoria com ID 1 no seeder
        $result = $this->model->update($id, $data);
        $this->assertTrue($result);

        $category = $this->model->find($id);
        $this->assertEquals('Updated Category', $category['name']);
        $this->assertEquals('updated-category', $category['slug']);
    }

    public function testDeleteCategory()
    {
        $id = 1; // Assumindo que existe uma categoria com ID 1 no seeder
        $result = $this->model->delete($id);
        $this->assertTrue($result);

        $category = $this->model->find($id);
        $this->assertNull($category);
    }
}
```

### Testes de Integração

Os testes de integração verificam a interação entre diferentes componentes do sistema.

#### Frameworks/Ferramentas:
- PHPUnit (integrado ao CodeIgniter 4)
- Feature Testing do CodeIgniter

#### Componentes a serem testados:
- Interação entre Models
- Fluxos completos de Controllers
- Interação com o banco de dados

#### Exemplos:

**Teste do fluxo de criação de produto**:
```php
<?php

namespace Tests\Integration;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductCategoryModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class ProductCreationTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $seed = 'Tests\Seeds\TestSeeder';
    protected $productModel;
    protected $categoryModel;
    protected $productCategoryModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productCategoryModel = new ProductCategoryModel();
    }

    public function testCreateProductWithCategories()
    {
        // Criar categoria para teste
        $categoryId = $this->categoryModel->insert([
            'name' => 'Test Category',
            'description' => 'For testing purposes',
            'status' => 1
        ]);

        // Dados do produto
        $productData = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'short_description' => 'Test product',
            'price' => 99.90,
            'stock_status' => 'instock',
            'status' => 1
        ];

        // Inserir produto
        $productId = $this->productModel->insert($productData);
        $this->assertIsNumeric($productId);
        $this->assertGreaterThan(0, $productId);

        // Associar produto à categoria
        $result = $this->productCategoryModel->insert([
            'product_id' => $productId,
            'category_id' => $categoryId
        ]);
        $this->assertTrue($result > 0);

        // Verificar se o produto existe e tem os dados corretos
        $product = $this->productModel->find($productId);
        $this->assertNotNull($product);
        $this->assertEquals('Test Product', $product['name']);
        $this->assertEquals('test-product', $product['slug']);
        $this->assertEquals(99.90, $product['price']);

        // Verificar se a relação produto-categoria existe
        $productCategories = $this->productCategoryModel
            ->where('product_id', $productId)
            ->where('category_id', $categoryId)
            ->findAll();
        $this->assertCount(1, $productCategories);
    }
}
```

### Testes de Feature

Os testes de feature verificam funcionalidades completas do sistema do ponto de vista do usuário.

#### Frameworks/Ferramentas:
- Feature Testing do CodeIgniter

#### Funcionalidades a serem testadas:
- Rotas e Controllers
- Requisições HTTP
- Resposta da aplicação

#### Exemplos:

**Teste de listagem de produtos**:
```php
<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class ProductListingTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    protected $refresh = true;
    protected $seed = 'Tests\Seeds\ProductSeeder';

    public function testProductListingPage()
    {
        $result = $this->call('get', '/shop');
        
        $result->assertOK();
        $result->assertSee('Products');
        
        // Verificar se os produtos do seeder estão sendo exibidos
        $result->assertSee('Product 1');
        $result->assertSee('Product 2');
    }

    public function testProductCategoryPage()
    {
        // Assumindo que existe uma categoria "electronics" com produtos no seeder
        $result = $this->call('get', '/category/electronics');
        
        $result->assertOK();
        $result->assertSee('Electronics');
        $result->assertSee('Product 1'); // Assumindo que Product 1 está nesta categoria
    }

    public function testProductDetailPage()
    {
        // Assumindo que existe um produto com slug "product-1" no seeder
        $result = $this->call('get', '/product/product-1');
        
        $result->assertOK();
        $result->assertSee('Product 1');
        $result->assertSee('Price');
        $result->assertSee('Description');
        $result->assertSee('WhatsApp');
    }
}
```

### Testes de Aceitação

Os testes de aceitação verificam se o sistema atende aos requisitos de negócio e funciona como esperado do ponto de vista do usuário final.

#### Frameworks/Ferramentas:
- Selenium WebDriver
- Codeception (opcional)

#### Cenários a serem testados:
- Fluxos completos de uso
- Interface do usuário
- Integrações externas (WhatsApp)

#### Exemplos:

**Teste do fluxo de contato via WhatsApp**:
```php
<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class WhatsAppContactCest
{
    public function _before(AcceptanceTester $I)
    {
        // Preparação, se necessário
    }

    // Teste do fluxo completo de visualização de produto e contato via WhatsApp
    public function tryToContactViaWhatsApp(AcceptanceTester $I)
    {
        // Navegar para a página de produto
        $I->amOnPage('/product/sample-product');
        $I->see('Sample Product');
        
        // Verificar se o botão do WhatsApp está presente
        $I->seeElement('a.whatsapp-button');
        
        // Clique no botão e verifique a URL de redirecionamento
        $href = $I->grabAttributeFrom('a.whatsapp-button', 'href');
        $I->assertStringContainsString('api.whatsapp.com/send', $href);
        $I->assertStringContainsString('Sample Product', $href);
    }
}
```

## Cobertura de Testes

### Métricas de Cobertura

O projeto visa atingir as seguintes métricas de cobertura:

- **Testes Unitários**: >80% do código
- **Testes de Integração**: >70% das funcionalidades críticas
- **Testes de Feature**: >60% das rotas e controllers
- **Testes de Aceitação**: Todos os fluxos principais de usuário

### Relatórios de Cobertura

Os relatórios de cobertura serão gerados automaticamente durante a execução dos testes usando:

```bash
php spark test --coverage-text
```

Para relatórios HTML mais detalhados:

```bash
php spark test --coverage-html reports/coverage
```

## Automação de Testes

### Integração Contínua

Os testes serão automatizados através de um pipeline de CI (GitHub Actions, Jenkins, etc.), que executará:

1. **Lint e análise estática**: Para verificar a qualidade do código
2. **Testes unitários e de integração**: Em cada commit/push
3. **Testes de feature**: Em Pull Requests
4. **Testes de aceitação**: Antes de deploy para produção

### Exemplo de Configuração GitHub Actions

```yaml
name: Tests

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main, develop ]

jobs:
  test:
    runs-on: ubuntu-latest
    
    services:
      mysql:
        image: mysql:5.7
        env:
          MYSQL_ROOT_PASSWORD: root
          MYSQL_DATABASE: test_db
        ports:
          - 3306:3306
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Set up PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.0'
        extensions: mbstring, intl, json, mysql
        coverage: xdebug
    
    - name: Install Dependencies
      run: composer install
    
    - name: Prepare Environment
      run: |
        cp env .env
        php spark key:generate
    
    - name: Run Database Migrations
      run: php spark migrate -all
    
    - name: Run Unit and Feature Tests
      run: php spark test
```

## Práticas Recomendadas

### Desenvolvimento Orientado a Testes (TDD)

Quando possível, adotar a abordagem TDD:

1. Escrever um teste que falha
2. Implementar o código para o teste passar
3. Refatorar o código mantendo o teste passando

### Testes de Regressão

Executar todos os testes após mudanças significativas para garantir que funcionalidades existentes não sejam quebradas.

### Mock Objects

Utilizar mocks para simular componentes externos ou de difícil teste:

```php
public function testProductServiceWithMockRepository()
{
    // Criar mock do repositório
    $repository = $this->createMock(ProductRepository::class);
    
    // Configurar comportamento esperado
    $repository->method('findById')
               ->willReturn([
                   'id' => 1,
                   'name' => 'Test Product',
                   'price' => 99.90
               ]);
    
    // Injetar mock no serviço
    $service = new ProductService($repository);
    
    // Testar método do serviço
    $product = $service->getProductById(1);
    
    // Verificar resultado
    $this->assertEquals('Test Product', $product['name']);
    $this->assertEquals(99.90, $product['price']);
}
```

## Documentação de Testes

### Estrutura dos Diretórios de Teste

```
tests/
  ├── Unit/           # Testes unitários
  │   ├── Models/     # Testes de models
  │   ├── Services/   # Testes de services
  │   └── Helpers/    # Testes de helpers
  │
  ├── Integration/    # Testes de integração
  │
  ├── Feature/        # Testes de feature
  │
  ├── Acceptance/     # Testes de aceitação
  │
  ├── Fixtures/       # Dados de teste
  │
  └── Seeds/          # Seeders para testes
```

### Convenções de Nomenclatura

- Classes de teste: `{Class}Test.php`
- Métodos de teste: `test{Functionality}()`
- Descrições claras e concisas para facilitar a identificação de falhas

## Considerações Finais

- Os testes devem ser executados regularmente, não apenas após grandes mudanças
- A cobertura de testes deve ser monitorada e melhorada continuamente
- Os testes devem ser tratados como parte essencial do código, não como uma tarefa secundária 