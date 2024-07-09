# Utiliser l'image officielle de Nginx comme base
FROM nginx:alpine

# Supprimer la configuration par défaut de Nginx
RUN rm /etc/nginx/conf.d/default.conf

# Copier la configuration personnalisée de Nginx
COPY nginx.conf /etc/nginx/conf.d

# Copier les fichiers de l'application dans le répertoire de Nginx
COPY . /usr/share/nginx/html

# Exposer le port 85
EXPOSE 85

# Démarrer Nginx
CMD ["nginx", "-g", "daemon off;"]
