**Teste para ExperMed**

Para criar a image:

`docker build -t expermed .`

Para criar container:

`docker run -p 5000:80 -v %seu_diretório%:/var/www/html --name expermed expermed:latest `

Para inicializar todas dependencias necessárias (Executar dentro do container):

`cd /var/www/html && yarn install && yarn build && cd datfile && chmod 777 data -Rf && composer install && httpd && nohup php /var/www/html/datfile/expermed.php &`

Interface acessível por http://localhost:5000/build