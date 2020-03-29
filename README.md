# DNS Manager

Gerenciador de DNS em Laravel para adicionar entradas de DNS em servidor Linux que usam BIND.

Esse projeto foi adaptado de [Alexandre Moraes Matos](https://github.com/AlexandreMT).

## Configurando um servidor Bind DNS no CentOS 7

https://www.digitalocean.com/community/tutorials/how-to-configure-bind-as-a-private-network-dns-server-on-centos-7


## Instalação

Requisitos 
- Apache
- PHP 7.2
- Composer
- Supervisor
- git

Baixar o repositório na máquina usando um usuário não root:

```console
$ git clone https://github.com/naranma/dnsmanager.git
```

Entre no diretório do projeto e execute o comando composer:
- Obs.: Por padrão o composer não executa usando o usuário root.

```console
$ composer install
```

Após executar a intalação, copie o diretório da instalação para o local definitivo.

## Configurando o aquivo .env

Entre no diretório do projeto e copie o arquivo `.env.example` para `.env`

```console
# cp .env.example .env
```

Edite o arquivo .env apontando o banco de dados:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=nome_do_usuario
DB_PASSWORD=senha
```

Para configurar usando Sqlite, crie um aquivo vazio no diretório `database`

```console
# touch database/database.sqlite
```

Configure o arquivo `.env` da seguinte forma.
```ini
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=database.sqlite
# DB_USERNAME=nome_do_usuario
# DB_PASSWORD=senha
```

### Chave do aplicativo

Gere uma chave para o aplicativo usando o seguinte comando.

```console
# php artisan key:generate
```

No aquivo `.env` será gerado uma chave de 32 caracteres na entrada `APP_KEY=`

## Migração do banco

Para gerar as tabelas do sistema no banco de dados, execute o seguinte comando:

```console
# php artisan make:migration --seed
```

### Diretório do DNS (named)

No aquivo `.env`, configure o diretório raiz para salvar os arquivos de DNS.

```ini
DNS_PATH=/tmp
```

## Configuração do LDAP

Configure as variáveis de ambiente do LDAP no aquivo `.env`

```ini
LDAP_HOST="host.dominio.com"
LDAP_USER_GROUP="NomeDoGroupo"
LDAP_DN="DC=host,DC=dominio,DC=com"
LDAP_DOM="@dominio.com"
```

## Configuração do Apache

Configure o apache apontando o diretório para o local de instalação do app.

```apache
<VirtualHost *:80>
    DocumentRoot "/local/dnsmanager/public"
    DirectoryIndex index.php
    <Directory "/local/dnsmanager/public">
        Options All
        AllowOverride All
        Order Allow,Deny
        Allow from all
    </Directory>
</VirtualHost>
```

### Configuração das permissões nos diretórios

Permissões gerais da aplicação.

```console
# chown -R root:root dnsmanager
# find dnsmanager/ -type d -exec chmod 755  {} +
# find dnsmanager/ -type f -exec chmod 644 {} +
```

Permissões do diretório storage da aplicação.

```console
# chown -R apache:apache dnsmanager/storage
# find dnsmanager/storage -type d -exec chmod 775 {} +
# find dnsmanager/storage -type f -exec chmod 666 {} +
```

Se estiver usando sqlite deve dar permissão de escrita no arquivo.

Exemplo do arquivo dentro da pasta database no projeto:
```console
# chmod 775 dnsmanager/database/database.sqlite
```

## Inicialize os serviços
Apache

```console
# systemctl start httpd

ou

# service httpd start
```
