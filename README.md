FTP-MAIL send messages over an ftp server BETA

-for ubunutu 14.04
sudo apt-get update
sudo apt-get install apache2 php5 libapache2-mod-php5 ncftp
sudo /etc/init.d/apache2 restart

-for ubunutu 16.04
sudo apt-get update
sudo apt-get install apache2 php libapache2-mod-php ncftp
sudo /etc/init.d/apache2 restart

-clone/compile and run autoftp
git clone https://github.com/pedrolpena/auto-ftp.git

-Open browser and type localhost int the address bar
to confirm apache is working.

-Verify php installation is working
php -r 'echo "\n\nYour PHP installation is working fine.\n\n\n";'

-add user to www-data
sudo usermod -G www-data -a $USER

-log out then log back in

-set permissions to write to the appropriate folders
sudo chgrp -R www-data /var/www
sudo chmod -R 775 /var/www
sudo chown -R www-data /var/www

-make queue writeable by www-data, the path is probably $HOME/auto_ftp_queue
sudo chown -R www-data $HOME/auto_ftp_queue

-download ftp email code from github. You can download the zip
or clone it if you have git installed.
git https://github.com/pedrolpena/ftp-mail.git

-copy the contents of the php folder to /var/www/html
cp -R ftp-mail/* /var/www/html/

-Update file paths and user names.

gedit /var/www/html/cfg/config.ini

[user_profile]
user = ax07

[paths]
outboxQueue = "write queue here"
inbox = "var/www/html/inbox"

-update ftp username and password variables in get_messages script
this will allow the script to download and delete messages on the ftp server

gedit /var/www/html/scripts/get_messages

USER="username goes here"
PASSWORD="password goes here"

-make get_messages executable and create a soft link for it to be inthe path.
chmod +x /var/www/html/scripts/get_messages
sudo ln -s /var/www/html/scripts/get_messages /usr/local/sbin

    create a crontan that runs get_messages every 2 minutes
