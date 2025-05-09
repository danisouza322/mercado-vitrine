# Guia de Implementação

Este documento apresenta um guia passo a passo para implementação do sistema, seguindo as melhores práticas e a arquitetura definida.

## Visão Geral das Fases

1. **Configuração Inicial**: Preparação do ambiente, instalação do CodeIgniter Shield
2. **Banco de Dados**: Criação das migrações e models
3. **Painel Administrativo**: Implementação das funcionalidades de administração
4. **Vitrine**: Implementação da vitrine de produtos com WhatsApp
5. **Finalização**: Testes, ajustes e deploy

## Fase 1: Configuração Inicial

### 1.1 Instalação do CodeIgniter Shield

Instale o Shield via Composer:

```bash
composer require codeigniter4/shield
```

Execute as migrações do Shield:

```bash
php spark migrate --all
```

Configure o Shield:

```bash
php spark shield:setup
php spark shield:publish
```

### 1.2 Configuração do Ambiente

Ajuste o arquivo `.env` com as configurações de banco de dados:

```
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = vitrine_online
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
```

### 1.3 Preparação da Estrutura de Diretórios

Crie os diretórios necessários:

```bash
mkdir -p app/Controllers/Admin
mkdir -p app/Controllers/Api
mkdir -p app/Models
mkdir -p app/Entities
mkdir -p app/Services
mkdir -p app/Filters
mkdir -p app/Helpers
mkdir -p app/Database/Migrations
mkdir -p app/Database/Seeds
mkdir -p public/uploads/products
mkdir -p public/uploads/categories
```

## Fase 2: Banco de Dados

### 2.1 Criação das Migrações

Crie as migrações para as tabelas necessárias:

```bash
php spark make:migration CreateCategoriesTable
php spark make:migration CreateProductsTable
php spark make:migration CreateProductCategoriesTable
php spark make:migration CreateProductImagesTable
php spark make:migration CreateSettingsTable
```

Implemente cada migração conforme o modelo definido no documento de banco de dados.

### 2.2 Criação dos Models

Crie os models para cada entidade:

```bash
php spark make:model CategoryModel
php spark make:model ProductModel
php spark make:model ProductCategoryModel
php spark make:model ProductImageModel
php spark make:model SettingModel
```

#### CategoryModel.php
```php
<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'slug', 'description', 'parent_id', 'image', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'name'     => 'required|min_length[3]|max_length[100]',
        'slug'     => 'permit_empty|is_unique[categories.slug,id,{id}]',
        'status'   => 'required|in_list[0,1]',
    ];
    
    // Método para criar slug automaticamente
    protected function beforeInsert(array $data)
    {
        if (empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        if (empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        
        return $data;
    }
    
    // Método para obter hierarquia de categorias
    public function getHierarchy()
    {
        $categories = $this->where('parent_id', null)
                           ->where('status', 1)
                           ->findAll();
                           
        foreach ($categories as &$category) {
            $category['children'] = $this->getChildren($category['id']);
        }
        
        return $categories;
    }
    
    private function getChildren($parentId)
    {
        $children = $this->where('parent_id', $parentId)
                         ->where('status', 1)
                         ->findAll();
                         
        foreach ($children as &$child) {
            $child['children'] = $this->getChildren($child['id']);
        }
        
        return $children;
    }
}
```

Implemente os demais models de forma similar, seguindo o padrão do CodeIgniter.

### 2.3 Criação dos Seeders

Crie seeders para dados iniciais:

```bash
php spark make:seeder CategorySeeder
php spark make:seeder SettingSeeder
php spark make:seeder AdminSeeder
```

#### SettingSeeder.php
```php
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'setting_key'   => 'store_name',
                'setting_value' => 'Vitrine Online',
            ],
            [
                'setting_key'   => 'store_description',
                'setting_value' => 'Sua vitrine de produtos online',
            ],
            [
                'setting_key'   => 'whatsapp_number',
                'setting_value' => '5511999999999',
            ],
            [
                'setting_key'   => 'whatsapp_message',
                'setting_value' => 'Olá! Estou interessado no produto: {product_name}. Poderia me dar mais informações?',
            ],
            // Adicione outras configurações conforme necessário
        ];

        $this->db->table('settings')->insertBatch($data);
    }
}
```

## Fase 3: Painel Administrativo

### 3.1 Controlador de Autenticação

Crie um controlador para autenticação:

```bash
php spark make:controller Admin/Auth
```

Implemente o controlador de autenticação conforme descrito no documento de autenticação.

### 3.2 Filtro de Autenticação

Crie um filtro para proteger as rotas administrativas:

```php
<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! auth()->loggedIn()) {
            return redirect()->to('admin/login');
        }

        if (! auth()->user()->inGroup('admin') && ! auth()->user()->inGroup('manager')) {
            return redirect()->to('admin/login')->with('error', 'Acesso não autorizado.');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
```

### 3.3 Configuração das Rotas

Atualize o arquivo `app/Config/Routes.php` para incluir as rotas administrativas:

```php
// Rotas de autenticação
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/login', 'Admin\Auth::attemptLogin');
$routes->get('admin/logout', 'Admin\Auth::logout');

// Rotas administrativas protegidas
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    
    // Categorias
    $routes->get('categories', 'Admin\Categories::index');
    $routes->get('categories/create', 'Admin\Categories::create');
    $routes->post('categories/store', 'Admin\Categories::store');
    $routes->get('categories/edit/(:num)', 'Admin\Categories::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\Categories::update/$1');
    $routes->get('categories/delete/(:num)', 'Admin\Categories::delete/$1');
    
    // Produtos
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->post('products/store', 'Admin\Products::store');
    $routes->get('products/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Products::update/$1');
    $routes->get('products/delete/(:num)', 'Admin\Products::delete/$1');
    
    // Configurações
    $routes->get('settings', 'Admin\Settings::index');
    $routes->post('settings/update', 'Admin\Settings::update');
});
```

### 3.4 Controladores Administrativos

Crie os controladores para gestão de categorias, produtos e configurações.

#### Admin/Products.php
```php
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductImageModel;

class Products extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $productImageModel;
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productImageModel = new ProductImageModel();
    }
    
    public function index()
    {
        $data = [
            'title'    => 'Gerenciar Produtos',
            'products' => $this->productModel->findAll()
        ];
        
        return view('admin/pages/products', $data);
    }
    
    public function create()
    {
        $data = [
            'title'      => 'Novo Produto',
            'categories' => $this->categoryModel->findAll()
        ];
        
        return view('admin/pages/product-form', $data);
    }
    
    public function store()
    {
        // Implementar lógica para salvar produto
    }
    
    public function edit($id)
    {
        // Implementar lógica para editar produto
    }
    
    public function update($id)
    {
        // Implementar lógica para atualizar produto
    }
    
    public function delete($id)
    {
        // Implementar lógica para excluir produto
    }
}
```

Implemente os demais controladores de forma similar.

### 3.5 Views Administrativas

Crie as views para cada seção administrativa:

#### admin/pages/login.php
```php
<?= $this->extend('admin/layouts/auth') ?>

<?= $this->section('content') ?>
<div class="card mx-auto card-login">
    <div class="card-body">
        <h4 class="card-title mb-4">Entrar</h4>
        
        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif; ?>
        
        <?php if (session()->has('message')) : ?>
            <div class="alert alert-success"><?= session('message') ?></div>
        <?php endif; ?>
        
        <form action="<?= base_url('admin/login') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <input class="form-control" placeholder="Email" type="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <input class="form-control" placeholder="Senha" type="password" name="password" required>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
```

Crie as views para gerenciamento de produtos, categorias e configurações de acordo com o template Nest.

## Fase 4: Vitrine

### 4.1 Controlador da Vitrine

Crie os controladores para a vitrine pública:

```bash
php spark make:controller Shop
php spark make:controller Product
```

#### Shop.php
```php
<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SettingModel;

class Shop extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $settingModel;
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->settingModel = new SettingModel();
    }
    
    public function index()
    {
        $data = [
            'title'       => 'Produtos',
            'products'    => $this->productModel->getFeaturedProducts(),
            'categories'  => $this->categoryModel->getHierarchy(),
            'settings'    => $this->settingModel->getSettings()
        ];
        
        return view('frontend/pages/shop', $data);
    }
    
    public function category($slug)
    {
        $category = $this->categoryModel->where('slug', $slug)->first();
        
        if (!$category) {
            return redirect()->to('/shop');
        }
        
        $data = [
            'title'      => $category['name'],
            'category'   => $category,
            'products'   => $this->productModel->getProductsByCategory($category['id']),
            'categories' => $this->categoryModel->getHierarchy(),
            'settings'   => $this->settingModel->getSettings()
        ];
        
        return view('frontend/pages/category', $data);
    }
}
```

#### Product.php
```php
<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SettingModel;

class Product extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $settingModel;
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->settingModel = new SettingModel();
    }
    
    public function view($slug)
    {
        $product = $this->productModel->getProductBySlug($slug);
        
        if (!$product) {
            return redirect()->to('/shop');
        }
        
        $settings = $this->settingModel->getSettings();
        
        // Gerar link do WhatsApp
        $whatsappMessage = str_replace(
            '{product_name}', 
            $product['name'], 
            $settings['whatsapp_message']
        );
        
        $whatsappLink = 'https://api.whatsapp.com/send?phone=' . 
                         $settings['whatsapp_number'] . 
                         '&text=' . urlencode($whatsappMessage);
        
        $data = [
            'title'        => $product['name'],
            'product'      => $product,
            'categories'   => $this->categoryModel->getHierarchy(),
            'settings'     => $settings,
            'whatsappLink' => $whatsappLink,
            'related'      => $this->productModel->getRelatedProducts($product['id'])
        ];
        
        return view('frontend/pages/product', $data);
    }
}
```

### 4.2 Rotas da Vitrine

Adicione as rotas da vitrine em `app/Config/Routes.php`:

```php
// Rotas da vitrine
$routes->get('/', 'Home::index');
$routes->get('/shop', 'Shop::index');
$routes->get('/category/(:segment)', 'Shop::category/$1');
$routes->get('/product/(:segment)', 'Product::view/$1');
```

### 4.3 Views da Vitrine

Crie as views da vitrine, utilizando o template Nest:

#### frontend/pages/product.php
```php
<?= $this->extend('frontend/layouts/default') ?>

<?= $this->section('content') ?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?= base_url('/') ?>" rel="nofollow">Home</a>
                <span></span> <a href="<?= base_url('shop') ?>">Shop</a>
                <span></span> <?= $product['name'] ?>
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <!-- Imagens do produto -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail"><?= $product['name'] ?></h2>
                                    <div class="product-detail-rating">
                                        <!-- Categorias do produto -->
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <?php if (!empty($product['sale_price'])): ?>
                                            <div class="product-price primary-color float-left">
                                                <ins><span class="text-brand"><?= 'R$ ' . number_format($product['sale_price'], 2, ',', '.') ?></span></ins>
                                                <ins><span class="old-price font-md ml-15"><?= 'R$ ' . number_format($product['price'], 2, ',', '.') ?></span></ins>
                                            </div>
                                        <?php else: ?>
                                            <div class="product-price primary-color float-left">
                                                <ins><span class="text-brand"><?= 'R$ ' . number_format($product['price'], 2, ',', '.') ?></span></ins>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="short-desc mb-30">
                                        <p><?= $product['short_description'] ?></p>
                                    </div>
                                    
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="product-extra-link2">
                                            <a href="<?= $whatsappLink ?>" target="_blank" class="button button-add-to-cart">Entre em contato pelo WhatsApp</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-style3">
                            <!-- Descrição do produto -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>
```

## Fase 5: Finalização

### 5.1 Ajustes Finais

- Verifique a responsividade em diferentes dispositivos
- Teste todas as funcionalidades
- Otimize imagens e assets
- Implemente helpers adicionais conforme necessário

### 5.2 Deploy

1. Configure o ambiente de produção
2. Atualize o arquivo `.env` para modo de produção
3. Execute as migrações e seeders
4. Configure permissões de arquivos e diretórios
5. Ajuste configurações de servidor web

## Dicas Importantes

1. **Validação de Formulários**: Sempre valide dados de entrada
2. **Feedback ao Usuário**: Forneça mensagens claras de sucesso/erro
3. **Otimização de Imagens**: Redimensione e comprima imagens
4. **Cache**: Utilize cache para melhorar performance
5. **Segurança**: Implemente proteção contra CSRF, XSS e SQL Injection

---

Siga este guia de implementação e consulte os outros documentos da pasta `docs` para detalhes específicos sobre cada componente do sistema. 