Instruções
========================

Bem-vindo(a)!

Para ser possível o teste da minha aplicação, 
serão necessárias 2 etapas:

1. Configurar a Aplicação!
2. Configurar o Banco de Dados!

==============================================

#1. Configurar a Aplicação
Todo o projeto já foi configurado via .htacces 
para funcionar melhor se utilizando um virtualHost.
(Somente assets de imagens não carregarão caso não utilize virtual host)

O servidor utilizado foi o apache, recomenda-se usar o 
mesmo servidor:

Para windows acesse a pasta: 
C:\xampp\apache\conf\extra

Abra o arquivo: httpd-vhosts.conf

Adicione o seguinte código o arquivo

```
<VirtualHost dev.grancursos:80>
    DocumentRoot "C:/xampp/htdocs/GranCursos/web"
    ServerName dev.grancursos
    ServerAlias www.dev.grancursos

    <Directory C:/xampp/htdocs/GranCursos/web>
        AllowOverride None
        Order Allow,Deny
        Allow from All

        FallbackResource /app_dev.php
    </Directory>

    <Directory C:/xampp/htdocs/GranCursos/web/bundles>
        FallbackResource disabled
    </Directory>
</VirtualHost>
```
LEMBRE-SE:

-Configure de acordo com o nome do seu diretório htdocs,
no meu caso: htdocs/GranCursos/web

-Configure para a pasta WEB

==============================================

#1. Configurar o Banco de Dados!

Crie 1 Banco de Dados com o nome grancursos

Execute o script de importação que está na raiz do projeto.

PS. O banco utilizado foi MySQL, verifique possíveis incopmatibilidades de nomeclatura.

==============================================
Caso necessite, usuario e senha do banco devem ser alterados no arquivo: app/config/parameters.yml
==============================================
 
Aproveite!
