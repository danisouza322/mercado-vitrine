# Fluxos de Aplicação

Este documento descreve os principais fluxos de interação e processos do sistema.

## Fluxos do Painel Administrativo

### Fluxo de Autenticação

```
┌───────────┐      ┌─────────┐      ┌────────────┐      ┌───────────┐
│           │      │         │      │            │      │           │
│  Acesso   │──────►  Login  │──────►  Validação  │──────►  Dashboard │
│           │      │         │      │            │      │           │
└───────────┘      └─────────┘      └────────────┘      └───────────┘
      ▲                                     │
      │                                     │
      │                                     ▼
      │                              ┌────────────┐
      │                              │            │
      └──────────────────────────────┤   Erro     │
                                     │            │
                                     └────────────┘
```

1. **Acesso**: O usuário tenta acessar uma área protegida do painel administrativo
2. **Login**: Se não estiver autenticado, é redirecionado para a página de login
3. **Validação**: O sistema valida as credenciais (email/senha)
4. **Dashboard**: Em caso de sucesso, o usuário é redirecionado para o dashboard
5. **Erro**: Em caso de falha, uma mensagem de erro é exibida

### Fluxo de Gestão de Categorias

```
┌────────────┐     ┌─────────────┐     ┌────────────┐     ┌─────────────┐
│            │     │             │     │            │     │             │
│  Listagem  │─────►  Formulário │─────►  Validação │─────►  Persistência│
│            │     │             │     │            │     │             │
└────────────┘     └─────────────┘     └────────────┘     └─────────────┘
      ▲                                       │                  │
      │                                       │                  │
      │                                       ▼                  │
      │                                ┌────────────┐           │
      │                                │            │           │
      │                                │   Erro     │           │
      │                                │            │           │
      │                                └────────────┘           │
      │                                                         │
      │                                                         │
      └─────────────────────────────────────────────────────────┘
```

1. **Listagem**: O administrador visualiza a lista de categorias
2. **Formulário**: Acessa o formulário para criar ou editar uma categoria
3. **Validação**: O sistema valida os dados enviados (nome, slug, etc.)
4. **Persistência**: Os dados são salvos no banco de dados
5. **Retorno**: O usuário é redirecionado para a listagem com mensagem de sucesso

### Fluxo de Gestão de Produtos

```
┌────────────┐     ┌─────────────┐     ┌────────────┐     ┌─────────────┐
│            │     │             │     │            │     │             │
│  Listagem  │─────►  Formulário │─────►  Validação │─────►  Persistência│
│            │     │             │     │            │     │             │
└────────────┘     └─────────────┘     └────────────┘     └─────────────┘
      ▲                  ▲                   │                  │
      │                  │                   │                  │
      │                  │                   ▼                  │
      │                  │            ┌────────────┐           │
      │                  │            │            │           │
      │                  │            │   Erro     │           │
      │                  │            │            │           │
      │                  │            └────────────┘           │
      │                  │                                     │
      │                  │            ┌────────────┐           │
      │                  └────────────┤   Upload   │◄──────────┘
      │                               │  Imagens   │           │
      │                               └────────────┘           │
      │                                                        │
      └────────────────────────────────────────────────────────┘
```

1. **Listagem**: O administrador visualiza a lista de produtos
2. **Formulário**: Acessa o formulário para criar ou editar um produto
   - Seleção de categorias
   - Upload de imagens
3. **Validação**: O sistema valida os dados do produto
4. **Persistência**: Os dados do produto são salvos no banco
5. **Upload de Imagens**: Processamento e armazenamento das imagens
6. **Retorno**: O usuário é redirecionado para a listagem com mensagem de sucesso

### Fluxo de Configurações

```
┌────────────┐     ┌─────────────┐     ┌────────────┐     ┌─────────────┐
│            │     │             │     │            │     │             │
│  Formulário│─────►  Validação  │─────►Persistência│─────►    Cache    │
│            │     │             │     │            │     │             │
└────────────┘     └─────────────┘     └────────────┘     └─────────────┘
      ▲                   │                                      │
      │                   │                                      │
      │                   ▼                                      │
      │            ┌────────────┐                               │
      │            │            │                               │
      │            │   Erro     │                               │
      │            │            │                               │
      │            └────────────┘                               │
      │                                                         │
      └─────────────────────────────────────────────────────────┘
```

1. **Formulário**: O administrador acessa o formulário de configurações
2. **Validação**: O sistema valida os dados enviados
3. **Persistência**: As configurações são salvas no banco de dados
4. **Cache**: Os dados de configuração são atualizados no cache
5. **Retorno**: O usuário é redirecionado para o formulário com mensagem de sucesso

## Fluxos da Vitrine

### Fluxo de Navegação

```
┌────────────┐     ┌─────────────┐     ┌────────────┐
│            │     │             │     │            │
│  Homepage  │─────►  Categorias │─────►  Produtos  │
│            │     │             │     │            │
└────────────┘     └─────────────┘     └────────────┘
      ▲                   ▲                  │
      │                   │                  │
      │                   │                  ▼
      │                   │           ┌────────────┐
      │                   │           │            │
      │                   └───────────┤   Detalhes │
      │                               │            │
      │                               └────────────┘
      │                                      │
      │                                      │
      │                                      ▼
      │                               ┌────────────┐
      │                               │            │
      └───────────────────────────────┤  WhatsApp  │
                                      │            │
                                      └────────────┘
```

1. **Homepage**: O cliente acessa a página inicial
2. **Categorias**: Navega pelas categorias de produtos
3. **Produtos**: Visualiza a listagem de produtos
4. **Detalhes**: Acessa a página de detalhes de um produto específico
5. **WhatsApp**: Clica no botão para entrar em contato via WhatsApp

### Fluxo de Contato via WhatsApp

```
┌────────────┐     ┌─────────────┐     ┌────────────┐
│            │     │             │     │            │
│  Produto   │─────►   Botão     │─────►  WhatsApp  │
│            │     │  WhatsApp   │     │   App      │
└────────────┘     └─────────────┘     └────────────┘
                                              │
                                              │
                                              ▼
                                       ┌────────────┐
                                       │            │
                                       │  Mensagem  │
                                       │ Pré-formatada│
                                       └────────────┘
```

1. **Produto**: O cliente visualiza os detalhes do produto
2. **Botão WhatsApp**: Clica no botão de contato
3. **WhatsApp App**: É redirecionado para o WhatsApp (app ou web)
4. **Mensagem Pré-formatada**: Uma mensagem pré-formatada é preenchida automaticamente

## Fluxos de Dados

### Fluxo de Dados para Exibição de Produtos

```
┌────────────┐     ┌─────────────┐     ┌────────────┐     ┌─────────────┐
│            │     │             │     │            │     │             │
│ Controller │─────► ProductModel│─────►CategoryModel─────►   View      │
│            │     │             │     │            │     │             │
└────────────┘     └─────────────┘     └────────────┘     └─────────────┘
                          │                                      ▲
                          │                                      │
                          ▼                                      │
                   ┌────────────┐                               │
                   │            │                               │
                   │ ImageModel │───────────────────────────────┘
                   │            │
                   └────────────┘
```

1. **Controller**: Recebe a requisição
2. **ProductModel**: Busca os dados do produto
3. **CategoryModel**: Busca as categorias relacionadas
4. **ImageModel**: Busca as imagens do produto
5. **View**: Renderiza a página com todos os dados

### Fluxo de Dados para Contato via WhatsApp

```
┌────────────┐     ┌─────────────┐     ┌────────────┐
│            │     │             │     │            │
│ Controller │─────►SettingModel │─────►   View     │
│            │     │             │     │            │
└────────────┘     └─────────────┘     └────────────┘
      │                                       │
      │                                       │
      ▼                                       ▼
┌────────────┐                        ┌────────────┐
│            │                        │            │
│ProductModel│                        │  WhatsApp  │
│            │                        │    Link    │
└────────────┘                        └────────────┘
```

1. **Controller**: Recebe a requisição
2. **SettingModel**: Busca as configurações (número de WhatsApp, mensagem padrão)
3. **ProductModel**: Busca os dados do produto
4. **View**: Gera o link de WhatsApp com a mensagem formatada
5. **WhatsApp Link**: Link com a URL para o WhatsApp e a mensagem pré-formatada

## Fluxos de Processamento

### Fluxo de Upload de Imagens

```
┌────────────┐     ┌─────────────┐     ┌────────────┐     ┌─────────────┐
│            │     │             │     │            │     │             │
│  Upload    │─────►  Validação  │─────►Processamento─────►Armazenamento│
│            │     │             │     │            │     │             │
└────────────┘     └─────────────┘     └────────────┘     └─────────────┘
                          │                                      │
                          │                                      │
                          ▼                                      ▼
                   ┌────────────┐                        ┌────────────┐
                   │            │                        │            │
                   │   Erro     │                        │   Banco    │
                   │            │                        │            │
                   └────────────┘                        └────────────┘
```

1. **Upload**: O administrador faz upload da imagem
2. **Validação**: Verifica tipo, tamanho e dimensões da imagem
3. **Processamento**: Redimensiona e otimiza a imagem
4. **Armazenamento**: Salva a imagem no diretório correto
5. **Banco**: Registra os metadados da imagem no banco de dados

### Fluxo de Geração de Slug

```
┌────────────┐     ┌─────────────┐     ┌────────────┐     ┌─────────────┐
│            │     │             │     │            │     │             │
│  Nome      │─────►Transformação│─────► Verificação│─────►  Persistência│
│            │     │             │     │            │     │             │
└────────────┘     └─────────────┘     └────────────┘     └─────────────┘
                                              │
                                              │
                                              ▼
                                       ┌────────────┐
                                       │            │
                                       │  Ajuste    │
                                       │            │
                                       └────────────┘
```

1. **Nome**: O administrador insere o nome do produto/categoria
2. **Transformação**: O nome é convertido para minúsculas, com traços no lugar de espaços
3. **Verificação**: O sistema verifica se o slug já existe
4. **Ajuste**: Se necessário, adiciona um sufixo para tornar o slug único
5. **Persistência**: O slug é salvo junto com os outros dados 