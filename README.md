# Fliglio Consul Demo App

## Install

### application scaffolding
	
	composer create-project consul-demo --dev


### vhost-myapp

	<VirtualHost *:80>
	    DocumentRoot "/var/www/my-app/web"
	    ServerName fl.local
	    <Directory "/var/www/my-app/web">

	        RewriteEngine On
	        RewriteCond %{SCRIPT_FILENAME} -f [OR]
	        RewriteCond %{SCRIPT_FILENAME} -d
	        RewriteRule .+ - [L]

	        RewriteRule ^(.*)$ /app.php [L,QSA]

	        AllowOverride all
	        Order allow,deny
	        Allow from all
	    </Directory>
	</VirtualHost>


