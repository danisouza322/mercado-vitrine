# Guia de Deploy

Este documento fornece instruções detalhadas para o deploy do sistema Vitrine Online em ambientes de produção.

## Pré-requisitos

### Requisitos de Servidor

- **Servidor Web**: Apache 2.4+ ou Nginx 1.18+
- **PHP**: 8.0+ com as seguintes extensões:
  - intl
  - mbstring
  - json
  - mysqlnd
  - xml
  - curl
  - gd ou imagick (para manipulação de imagens)
- **Banco de Dados**: MySQL 5.7+ ou MariaDB 10.3+
- **SSL**: Certificado SSL válido para HTTPS

### Requisitos de Software

- **Composer**: Para instalação de dependências
- **Git**: Para obtenção do código fonte (opcional)

## Passos para Deploy

### 1. Preparação do Ambiente

#### 1.1. Configuração do Servidor Web

**Apache**:

```apache
<VirtualHost *:80>
    ServerName vitrine.example.com
    
    # Redirecionar para HTTPS
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</VirtualHost>

<VirtualHost *:443>
    ServerName vitrine.example.com
    DocumentRoot /var/www/vitrine/public
    
    <Directory /var/www/vitrine/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Configuração SSL
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    SSLCertificateChainFile /path/to/chain.crt
    
    # Logs
    ErrorLog ${APACHE_LOG_DIR}/vitrine-error.log
    CustomLog ${APACHE_LOG_DIR}/vitrine-access.log combined
</VirtualHost>
```

**Nginx**:

```nginx
server {
    listen 80;
    server_name vitrine.example.com;
    
    # Redirecionar para HTTPS
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    server_name vitrine.example.com;
    
    root /var/www/vitrine/public;
    index index.php index.html;
    
    # Configuração SSL
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    ssl_trusted_certificate /path/to/chain.crt;
    
    # Configurações de segurança SSL
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_prefer_server_ciphers on;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-SHA384;
    ssl_session_timeout 1d;
    ssl_session_cache shared:SSL:10m;
    ssl_stapling on;
    ssl_stapling_verify on;
    
    # Headers de segurança
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    
    # Configuração para CodeIgniter
    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    # Negar acesso a arquivos ocultos
    location ~ /\. {
        deny all;
    }
    
    # Logs
    access_log /var/log/nginx/vitrine-access.log;
    error_log /var/log/nginx/vitrine-error.log;
}
```

#### 1.2. Configuração do PHP

Ajuste o `php.ini` para valores recomendados em produção:

```
; Configurações gerais
memory_limit = 256M
max_execution_time = 30
max_input_time = 60
post_max_size = 20M
upload_max_filesize = 10M

; Segurança
expose_php = Off
display_errors = Off
display_startup_errors = Off
log_errors = On
error_log = /var/log/php/error.log

; Sessão
session.cookie_httponly = 1
session.use_strict_mode = 1
session.cookie_secure = 1
```

### 2. Deploy do Código

#### 2.1. Obtenção do Código

**Via Git**:

```bash
# Clonar o repositório
git clone https://github.com/seu-usuario/vitrine-online.git /var/www/vitrine

# Alternar para a branch estável (se necessário)
cd /var/www/vitrine
git checkout main
```

**Ou via Upload**:

Faça upload de todos os arquivos do projeto para o diretório `/var/www/vitrine` no servidor.

#### 2.2. Instalação de Dependências

```bash
cd /var/www/vitrine
composer install --no-dev --optimize-autoloader
```

### 3. Configuração do Projeto

#### 3.1. Arquivo de Ambiente

Crie/edite o arquivo `.env` com as configurações de produção:

```
CI_ENVIRONMENT = production

app.baseURL = 'https://vitrine.example.com'

database.default.hostname = localhost
database.default.database = vitrine_db
database.default.username = db_user
database.default.password = secure_password
database.default.DBDriver = MySQLi
```

#### 3.2. Configuração do banco de dados

```bash
# Criar banco de dados (se necessário)
mysql -u root -p -e "CREATE DATABASE vitrine_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Criar usuário do banco (se necessário)
mysql -u root -p -e "CREATE USER 'db_user'@'localhost' IDENTIFIED BY 'secure_password';"
mysql -u root -p -e "GRANT ALL PRIVILEGES ON vitrine_db.* TO 'db_user'@'localhost';"
mysql -u root -p -e "FLUSH PRIVILEGES;"
```

#### 3.3. Executar migrações e seeders

```bash
cd /var/www/vitrine
php spark migrate -all
php spark db:seed InitialSeeder
```

### 4. Configuração do Shield

```bash
# Configurar o Shield
php spark shield:setup
php spark shield:publish

# Criar usuário admin (se não existir)
php spark shield:create_user admin@example.com admin123456 "Administrator"
php spark shield:admin admin@example.com
```

### 5. Permissões de Arquivos

```bash
# Definir proprietário correto
chown -R www-data:www-data /var/www/vitrine

# Definir permissões adequadas
find /var/www/vitrine -type f -exec chmod 644 {} \;
find /var/www/vitrine -type d -exec chmod 755 {} \;

# Permissões especiais para diretórios de escrita
chmod -R 775 /var/www/vitrine/writable
```

### 6. Upload de Arquivos

Crie e configure as permissões para os diretórios de upload:

```bash
mkdir -p /var/www/vitrine/public/uploads/products
mkdir -p /var/www/vitrine/public/uploads/categories

chmod -R 775 /var/www/vitrine/public/uploads
chown -R www-data:www-data /var/www/vitrine/public/uploads
```

### 7. Cache e Otimização

#### 7.1. Limpar cache

```bash
php spark cache:clear
```

#### 7.2. Configurar cache de rotas e arquivos

Edite o arquivo `app/Config/Cache.php` para ativar o cache em produção.

### 8. Verificação Final

Execute o seguinte checklist antes de considerar o deploy concluído:

- [ ] O site está acessível via HTTPS
- [ ] As páginas principais estão carregando corretamente
- [ ] O login administrativo funciona
- [ ] As permissões de arquivos e diretórios estão corretas
- [ ] Os formulários funcionam corretamente
- [ ] As imagens e arquivos estáticos estão sendo servidos corretamente

## Manutenção Contínua

### Atualizações

Para atualizar o sistema:

```bash
# Via Git
cd /var/www/vitrine
git pull origin main

# Atualizar dependências
composer install --no-dev --optimize-autoloader

# Executar migrações pendentes
php spark migrate -all

# Limpar cache
php spark cache:clear

# Verificar/corrigir permissões
chown -R www-data:www-data /var/www/vitrine
```

### Backup

Configure backups regulares:

1. **Banco de dados**:

```bash
# Backup do banco de dados
mysqldump -u db_user -p vitrine_db > /backup/vitrine_db_$(date +%Y%m%d).sql

# Comprimir backup
gzip /backup/vitrine_db_$(date +%Y%m%d).sql
```

2. **Arquivos**:

```bash
# Backup dos arquivos do site
tar -czf /backup/vitrine_files_$(date +%Y%m%d).tar.gz /var/www/vitrine
```

3. **Script de Backup Automatizado** (exemplo para crontab):

```
# Backup diário às 2h da manhã
0 2 * * * /path/to/backup_script.sh
```

### Monitoramento

Recomenda-se configurar monitoramento para:

- Uptime do servidor
- Uso de recursos (CPU, memória, disco)
- Erros nos logs do servidor e da aplicação
- Tempo de resposta das páginas
- Expiração do certificado SSL

## Solução de Problemas

### Logs

Para diagnóstico de problemas, verifique os seguintes logs:

- **Logs do PHP**: `/var/log/php/error.log` (ou conforme configurado)
- **Logs da Aplicação**: `/var/www/vitrine/writable/logs/`
- **Logs do Servidor Web**:
  - Apache: `/var/log/apache2/vitrine-error.log`
  - Nginx: `/var/log/nginx/vitrine-error.log`

### Problemas Comuns

1. **Erro 500 Internal Server Error**:
   - Verifique permissões de arquivos
   - Verifique configuração do `.env`
   - Examine os logs de erro

2. **Problemas de Upload de Imagens**:
   - Verifique permissões do diretório `/public/uploads/`
   - Verifique limites de tamanho no `php.ini`

3. **Erros de Banco de Dados**:
   - Verifique credenciais no `.env`
   - Verifique se o banco está online e acessível
   - Verifique permissões do usuário do banco

4. **Problemas com Cache**:
   - Limpe o cache: `php spark cache:clear`
   - Verifique permissões do diretório `writable/cache/` 