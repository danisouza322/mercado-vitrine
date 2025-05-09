# Autenticação com CodeIgniter Shield

## Visão Geral

O sistema utiliza o CodeIgniter Shield para autenticação e autorização. O Shield é a solução oficial de autenticação para CodeIgniter 4, fornecendo recursos abrangentes para gestão de usuários, autenticação e controle de acesso.

## Instalação e Configuração

### Instalação via Composer

```bash
composer require codeigniter4/shield
```

### Configuração Inicial

1. Execute as migrações do Shield para criar as tabelas necessárias:

```bash
php spark migrate --all
```

2. Execute o seeder para criar os grupos e permissões padrão:

```bash
php spark shield:setup
```

### Arquivos de Configuração

O Shield possui vários arquivos de configuração que podem ser publicados no diretório `app/Config`:

```bash
php spark shield:publish
```

Isso criará os seguintes arquivos:
- `app/Config/Auth.php`
- `app/Config/AuthGroups.php`

## Grupos e Permissões

O sistema utilizará os seguintes grupos de usuários:

### Grupo `admin`

Administradores com acesso completo ao painel administrativo.

**Permissões**:
- `admin.access` - Acesso ao painel administrativo
- `products.manage` - Gestão completa de produtos
- `categories.manage` - Gestão completa de categorias
- `settings.manage` - Alteração das configurações do sistema

### Grupo `manager`

Gerentes com acesso limitado ao painel administrativo.

**Permissões**:
- `admin.access` - Acesso ao painel administrativo
- `products.manage` - Gestão completa de produtos
- `categories.manage` - Gestão completa de categorias

## Configuração dos Grupos

A configuração dos grupos será realizada no arquivo `app/Config/AuthGroups.php`:

```php
<?php

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     */
    public array $groups = [
        'admin' => [
            'title'       => 'Admin',
            'description' => 'Administrador completo do sistema',
        ],
        'manager' => [
            'title'       => 'Gerente',
            'description' => 'Gerente com acesso limitado',
        ],
        'user' => [
            'title'       => 'User',
            'description' => 'General user of the site.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     */
    public array $permissions = [
        'admin.access'      => 'Pode acessar o painel administrativo',
        'products.manage'   => 'Pode gerenciar produtos',
        'categories.manage' => 'Pode gerenciar categorias',
        'settings.manage'   => 'Pode alterar configurações do sistema',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     */
    public array $matrix = [
        'admin' => [
            'admin.access',
            'products.manage',
            'categories.manage',
            'settings.manage',
        ],
        'manager' => [
            'admin.access',
            'products.manage',
            'categories.manage',
        ],
    ];
}
```

## Proteção das Rotas Administrativas

Para proteger as rotas do painel administrativo, será utilizado um filtro baseado no Shield:

### Criação do Filtro AdminFilter

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

### Registro do Filtro

No arquivo `app/Config/Filters.php`:

```php
<?php

namespace Config;

use App\Filters\AdminFilter;
use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    // ...
    
    public $aliases = [
        // ...
        'admin' => AdminFilter::class,
    ];
    
    // ...
}
```

### Aplicação do Filtro nas Rotas Administrativas

No arquivo `app/Config/Routes.php`:

```php
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    // Rotas administrativas protegidas
    // ...
});

// Exceções para login/logout
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/login', 'Admin\Auth::attemptLogin');
$routes->get('admin/logout', 'Admin\Auth::logout');
```

## Controlador de Autenticação

Para gerenciar o login e logout no painel administrativo, será criado um controlador específico:

```php
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Se já estiver logado, redireciona para o dashboard
        if (auth()->loggedIn()) {
            return redirect()->to('admin');
        }
        
        return view('admin/pages/login');
    }
    
    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $credentials = [
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $loginAttempt = auth()->attempt($credentials);
        
        if (! $loginAttempt->isOK()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $loginAttempt->reason());
        }
        
        // Verificar se o usuário pertence aos grupos permitidos
        $user = auth()->user();
        if (! $user->inGroup('admin') && ! $user->inGroup('manager')) {
            auth()->logout();
            return redirect()->to('admin/login')
                ->with('error', 'Você não tem permissão para acessar o painel administrativo.');
        }
        
        return redirect()->to('admin')
            ->with('message', 'Login realizado com sucesso!');
    }
    
    public function logout()
    {
        auth()->logout();
        
        return redirect()->to('admin/login')
            ->with('message', 'Logout realizado com sucesso!');
    }
}
```

## Criação de Usuário Administrativo

Para criar o primeiro usuário administrativo, será utilizado um seeder:

```php
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();
        
        $user = new User([
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => 'admin123456',
        ]);
        
        $users->save($user);
        
        $user = $users->findById($users->getInsertID());
        
        $user->addGroup('admin');
    }
}
```

Para executar o seeder:

```bash
php spark db:seed AdminSeeder
```

## Interface de Login

A interface de login será baseada no template Nest, mantendo a consistência visual com o restante do painel administrativo. 