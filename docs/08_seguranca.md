# Segurança

Este documento descreve as medidas de segurança implementadas no sistema de Vitrine Online.

## Visão Geral

A segurança é um aspecto crítico do sistema, especialmente considerando que envolve um painel administrativo com acesso a dados sensíveis. As medidas de segurança são implementadas em diversos níveis, desde a autenticação e autorização até a proteção contra vulnerabilidades comuns.

## Autenticação e Autorização

### CodeIgniter Shield

O sistema utiliza o CodeIgniter Shield, que é a biblioteca oficial de autenticação e autorização para CodeIgniter 4. O Shield implementa:

- **Armazenamento seguro de senhas**: Utilizando algoritmos de hash modernos (Argon2id ou Bcrypt)
- **Proteção contra ataques de força bruta**: Limitação de tentativas de login
- **Sistema de tokens**: Para gerenciamento de sessões seguras
- **Grupos e permissões**: Para controle granular de acesso

### Filtro de Acesso Administrativo

Todas as rotas administrativas são protegidas por um filtro específico que verifica:

1. Se o usuário está autenticado
2. Se o usuário pertence a um grupo autorizado (admin ou manager)

```php
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
```

## Proteção contra Vulnerabilidades Web Comuns

### Cross-Site Scripting (XSS)

- **Escape automático de saída**: O CodeIgniter 4 faz escape automático das variáveis nas views
- **Validação de entrada**: Todos os dados de entrada são validados antes de processamento
- **Content Security Policy (CSP)**: Configurado para restringir fontes de conteúdo

### Cross-Site Request Forgery (CSRF)

- **Tokens CSRF**: Implementado em todos os formulários
- **Middleware global**: Verificação automática de tokens CSRF em todas as requisições POST, PUT, DELETE

```php
// Token CSRF em formulários
<?= csrf_field() ?>

// Verificação no Config/Filters.php
public $globals = [
    'before' => [
        'csrf',
        // outros filtros...
    ],
    'after' => [
        // filtros...
    ],
];
```

### SQL Injection

- **Queries parametrizadas**: Uso exclusivo de queries parametrizadas via Query Builder do CodeIgniter
- **ORM**: Uso do Model nativo do CodeIgniter que implementa proteção contra SQL Injection
- **Validação de tipos**: Verificação de tipos de dados antes da execução de queries

### Carregamento e Upload de Arquivos

- **Validação de tipo MIME**: Verificação do tipo real do arquivo, não apenas da extensão
- **Verificação de tamanho**: Limites para tamanho de arquivos
- **Renomeação segura**: Arquivos são renomeados ao serem salvos para evitar conflitos e ataques
- **Armazenamento externo ao webroot**: Quando possível, arquivos sensíveis são armazenados fora do diretório web

```php
$validationRules = [
    'userfile' => [
        'label' => 'Image File',
        'rules' => 'uploaded[userfile]'
            . '|is_image[userfile]'
            . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
            . '|max_size[userfile,2048]'
    ],
];
```

## Headers de Segurança

O sistema implementa diversos headers HTTP de segurança:

```php
// Em app/Config/Filters.php ou middleware personalizado
$response->setHeader('X-Content-Type-Options', 'nosniff');
$response->setHeader('X-Frame-Options', 'SAMEORIGIN');
$response->setHeader('X-XSS-Protection', '1; mode=block');
$response->setHeader('Referrer-Policy', 'no-referrer-when-downgrade');
$response->setHeader('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.example.com;");
```

## Segurança nas Configurações

### Variáveis de Ambiente

Informações sensíveis são armazenadas em variáveis de ambiente, não diretamente no código:

- Credenciais de banco de dados
- Chaves de API
- Configurações de email
- Senhas e tokens

### Configuração do PHP

Recomendações de configurações seguras para o PHP no ambiente de produção:

```
display_errors = Off
log_errors = On
error_log = /path/to/error.log
expose_php = Off
allow_url_fopen = Off
```

## Logs e Monitoramento

- **Logs detalhados**: Registro de ações sensíveis (login, alterações de dados, etc.)
- **Níveis de log configuráveis**: Diferentes níveis de detalhamento baseados no ambiente (dev/prod)
- **Rotação de logs**: Evitar arquivos de log muito grandes e facilitar o gerenciamento

```php
// Exemplo de log de ação sensível
log_message('alert', 'Usuário {username} alterou a configuração {config_key}', [
    'username'   => $user->username,
    'config_key' => $key,
    'ip_address' => $this->request->getIPAddress()
]);
```

## Validação de Dados

Todas as entradas de usuário são validadas usando o sistema de validação do CodeIgniter:

```php
$rules = [
    'name'        => 'required|min_length[3]|max_length[255]',
    'email'       => 'required|valid_email|is_unique[users.email,id,{id}]',
    'price'       => 'required|numeric|greater_than[0]',
    'description' => 'required|string',
];

if (! $this->validate($rules)) {
    return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
}
```

## Armazenamento Seguro de Senhas

As senhas são armazenadas com hash seguro:

- Uso do algoritmo Argon2id (preferencial) ou Bcrypt
- Fatores de trabalho/custo configuráveis
- Verificação de força de senha durante o cadastro e alteração

## Boas Práticas Adicionais

- **Princípio do privilégio mínimo**: Usuários têm acesso apenas ao necessário para suas funções
- **Atualizações regulares**: Manter o framework e dependências atualizados
- **Sanitização de saída**: Além do escape automático, sanitização adicional para contextos específicos
- **Mensagens de erro genéricas**: Não revelar informações sensíveis em mensagens de erro
- **HTTPS**: Uso obrigatório de HTTPS em produção
- **Cache seguro**: Não armazenar informações sensíveis em cache

## Recomendações para Deploy

- Uso de certificado SSL/TLS válido e atualizado
- Configuração adequada do servidor web (Apache/Nginx)
- Desativação de módulos e funcionalidades desnecessários
- Firewall e configurações de rede apropriadas
- Backup regular e seguro dos dados 