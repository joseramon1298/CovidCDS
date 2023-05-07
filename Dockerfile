# Utilizar una imagen base de Apache
FROM httpd:2.4

# Cambiar el puerto en el que Apache escucha
RUN sed -i 's/Listen 80/Listen 4600/' /usr/local/apache2/conf/httpd.conf

# Copiar los archivos de la aplicación en el directorio de documentos de Apache
COPY AngularJSUI/ /usr/local/apache2/htdocs/