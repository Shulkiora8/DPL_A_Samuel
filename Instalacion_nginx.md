sudo apt update
apt install nginx
systemctl status nginx
nginx -t
cd /etc/nginx
ls
cd sites-available
ls
cd sites-enabled
ls -l
cat default
cd /var/www/html
ls -l
systemctl restart nginx
rm index.nginx-debian.html
nano index.html
systemctl restart nginx
systemctl status nginx
