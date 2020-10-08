## Fontes do site institucional AddressForAll.org
Design inspirado no similar francês https://adresse.data.gouv.fr/

HTML5+CSS puro, com gerenciamento de includes PHP ou linguagem instalada no server.

O portal ainda faz uso de outras pastas, relativas a material para download, APIs, etc. mantidas em backups e outros repositorios git.

## Instalação

Foram convencionadas as seguintes pastas no servidor NGINX: root em `/var/www/addressforall.org/` e fontes para link simbolico em  `/opt/gits`. Para instalar, depois do `git clone` em `/opt/gits`:
```sh
ln -s /opt/gits/site/default  /var/www/addressforall.org/default
ln -s /opt/gits/site/assets  /var/www/addressforall.org/assets
```
Supondo PHP, preparar `/etc/nginx/sites-available/conf` com

```nginx
server {
        server_name addressforall.org addressforall.com;
        access_log /var/log/nginx/addressforall.org.access_log;
        root /var/www/addressforall.org/;
        index  index.php index.html index.htm;
        location / {
          try_files $uri $uri/ /index.php?uri=$uri;
        }
        location ~ \.php$ {
          include snippets/fastcgi-php.conf;
          fastcgi_pass unix:/run/php/php7.4-fpm.sock;
        }
}
```

## Atualizações

Depois de atualizar este repositorio, atualizar o servidor com:
```sh
cd /opt/gits/site; sudo git pull
cp /opt/gits/site/index.php  /var/www/addressforall.org
```
