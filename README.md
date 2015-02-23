# Fliglio Consul App

see [fliglio consul vagrant](https://github.com/fliglio/fliglio-consul-vagrant) for instructions on testing this in a vagrant cluster with consul running


## Install

### application scaffolding
	
	composer create-project fliglio/consul-app --dev


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


