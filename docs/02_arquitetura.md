# Arquitetura do Sistema

## Visão Geral da Arquitetura

O sistema segue o padrão arquitetural MVC (Model-View-Controller) com uma camada adicional de Serviços para garantir melhor separação de responsabilidades. A estrutura é baseada nas convenções do CodeIgniter 4, utilizando seus recursos e componentes nativos.

```
+--------------------+       +-------------------+
|                    |       |                   |
|  Controllers       +------>+  Services         |
|                    |       |                   |
+--------+-----------+       +---------+---------+
         |                             |
         v                             v
+--------+-----------+       +---------+---------+
|                    |       |                   |
|  Views             |       |  Models           |
|                    |       |                   |
+--------------------+       +-------------------+
```

## Componentes Principais

### 1. Módulo de Autenticação (Shield)

**Responsabilidade**: Gerenciar autenticação e autorização de usuários administrativos.

**Componentes**:
- Controllers de autenticação (login, logout, registro)
- Middleware para verificação de autenticação
- Entidades de usuário e grupos
- Views para formulários de autenticação

**Dependências**:
- CodeIgniter Shield

### 2. Módulo de Produtos

**Responsabilidade**: Gerenciar o catálogo de produtos.

**Componentes**:
- Controllers para CRUD de produtos
- Services para lógica de negócios
- Models para persistência
- Views para listagem e formulários
- Entidades de produto

**Dependências**:
- Módulo de Categorias
- Módulo de Imagens

### 3. Módulo de Categorias

**Responsabilidade**: Gerenciar categorias de produtos.

**Componentes**:
- Controllers para CRUD de categorias
- Services para lógica de negócios
- Models para persistência
- Views para listagem e formulários
- Entidades de categoria

### 4. Módulo de Imagens

**Responsabilidade**: Gerenciar imagens de produtos.

**Componentes**:
- Controllers para upload e gestão
- Services para processamento e armazenamento
- Models para persistência
- Bibliotecas de manipulação de imagens

### 5. Módulo de Configurações

**Responsabilidade**: Gerenciar configurações da loja.

**Componentes**:
- Controllers para edição de configurações
- Services para lógica de negócios
- Models para persistência
- Views para formulários

### 6. Módulo de Vitrine (Frontend)

**Responsabilidade**: Exibir produtos e facilitar contato por WhatsApp.

**Componentes**:
- Controllers públicos
- Views para exibição de produtos
- Services para busca e filtragem
- Componentes de interface para contato via WhatsApp

## Estrutura de Diretórios

```
/app
  /Config       - Configurações da aplicação
  /Controllers
    /Admin      - Controllers administrativos
    /Frontend   - Controllers da vitrine
  /Models       - Models para persistência de dados
  /Entities     - Entidades de domínio
  /Filters      - Middleware e filtros
  /Helpers      - Funções auxiliares
  /Libraries    - Bibliotecas personalizadas
  /Services     - Serviços para lógica de negócios
  /ThirdParty   - Integrações com serviços externos
  /Views
    /admin      - Views do painel administrativo
    /frontend   - Views da vitrine online
    /partials   - Componentes reutilizáveis
    /layouts    - Layouts base
/public
  /assets       - Arquivos estáticos (CSS, JS, imagens)
  /uploads      - Imagens de produtos e categorias
/docs           - Documentação do projeto
```

## Fluxo de Dados

### Fluxo de Administração de Produtos

1. Administrador acessa a área protegida (verificação por Shield)
2. Controller Admin/Products recebe solicitação
3. Controller chama Service apropriado
4. Service executa lógica de negócios, utilizando Models
5. Os dados são persistidos no banco de dados
6. Controller renderiza View com resposta

### Fluxo de Exibição de Produtos na Vitrine

1. Cliente acessa página de produtos
2. Controller Frontend/Products recebe solicitação
3. Controller chama Service de produtos
4. Service busca dados através dos Models
5. Controller renderiza View com produtos
6. Cliente visualiza produtos e pode clicar no botão de WhatsApp

## Decisões Arquiteturais

1. **Uso de Services**: Camada adicional entre Controllers e Models para encapsular lógica de negócios
2. **Shield para Autenticação**: Utilização do pacote oficial do CodeIgniter para autenticação
3. **Upload de Imagens**: Sistema separado para gerenciar imagens e otimizá-las
4. **Configurações em Banco**: Armazenar configurações no banco para facilitar a edição
5. **Cache de Dados**: Utilizar cache para consultas frequentes e melhorar performance 