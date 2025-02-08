# intervolgatest
Точка входа в проект /public/index.php
Используемая конфигурация для nginx

    server {
        listen 80;
        server_name intervolga.local;
    
        root /path/to/intervolgatest/public;
        index index.php;
    
        location ~ \.php$ {
            include fastcgi.conf;
            fastcgi_pass unix:/run/php-fpm/php-fpm.sock;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
    
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
    
        location ~ /\.ht {
            deny all;
        }
    }
Для заполнения бд: 

    php path/to/core/Migration.php
