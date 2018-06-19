FTP-MAIL send messages over an ftp server BETA

Disclaimer
==========
This repository is a scientific product and is not official communication of the National Oceanic and
Atmospheric Administration, or the United States Department of Commerce. All NOAA GitHub project code is
provided on an ‘as is’ basis and the user assumes responsibility for its use. Any claims against the Department of
Commerce or Department of Commerce bureaus stemming from the use of this GitHub project will be governed
by all applicable Federal law. Any reference to specific commercial products, processes, or services by service
mark, trademark, manufacturer, or otherwise, does not constitute or imply their endorsement, recommendation or
favoring by the Department of Commerce. The Department of Commerce seal and logo, or the seal and logo of a
DOC bureau, shall not be used in any manner to imply endorsement of any commercial product or activity by
DOC or the United States Government.


-for ubunutu 14.04<br>
sudo apt-get update<br>
sudo apt-get install apache2 php5 libapache2-mod-php5 ncftp<br>
sudo /etc/init.d/apache2 restart<br>

-for ubunutu 16.04<br>
sudo apt-get update<br>
sudo apt-get install apache2 php libapache2-mod-php ncftp<br>
sudo /etc/init.d/apache2 restart<br>

-clone/compile and run autoftp<br>
git clone https://github.com/pedrolpena/auto-ftp.git<br>

-Open browser and type localhost int the address bar<br>
to confirm apache is working.<br>

-Verify php installation is working<br>
php -r 'echo "\n\nYour PHP installation is working fine.\n\n\n";'<br>

-add user to www-data<br>
sudo usermod -G www-data -a $USER<br>

-log out then log back in<br>

-set permissions to write to the appropriate folders<br>
sudo chgrp -R www-data /var/www<br>
sudo chmod -R 775 /var/www<br>
sudo chown -R www-data /var/www<br>

-make queue writeable by www-data, the path is probably $HOME/auto_ftp_queue<br>
sudo chown -R www-data $HOME/auto_ftp_queue<br>

-download ftp email code from github. You can download the zip<br>
or clone it if you have git installed.<br>
git https://github.com/pedrolpena/ftp-mail.git<br>

-copy the contents of the php folder to /var/www/html<br>
cp -R ftp-mail/* /var/www/html/<br>

-Update file paths and user names.<br>

gedit /var/www/html/cfg/config.ini<br>

[user_profile]<br>
user = ax07<br>

[paths]
outboxQueue = "write queue here"<br>
inbox = "var/www/html/inbox"<br>

-update ftp username and password variables in get_messages script<br>
this will allow the script to download and delete messages on the ftp server<br>

gedit /var/www/html/scripts/get_messages<br>

USER="username goes here"<br>
PASSWORD="password goes here"<br>

-make get_messages executable and create a soft link for it to be inthe path.<br>
chmod +x /var/www/html/scripts/get_messages<br>
sudo ln -s /var/www/html/scripts/get_messages /usr/local/sbin<br>

-make sure only the local computer(127.0.0.1) can access the webpage.
You can do this by modifying the Listen directive.

On Ubuntu 16.04

edit the file
/etc/apache2/ports.conf

Below is an example of what it looks like on my test computer.

```
# If you just change the port or add more ports here, you will likely also
# have to change the VirtualHost statement in
# /etc/apache2/sites-enabled/000-default.conf

Listen 127.0.0.1:80

<IfModule ssl_module>
	Listen 127.0.0.1:443
</IfModule>

<IfModule mod_gnutls.c>
	Listen 127.0.0.1:443
</IfModule>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
```

Restart the apache daemon

```
sudo service apache2 restart
```



create a crontab that runs get_messages every 2 minutes<br>
