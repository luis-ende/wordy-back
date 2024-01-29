#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
#
# If you have user-specific configurations you would like
# to apply, you may also create user-customizations.sh,
# which will be run after this script.


# If you're not quite ready for the latest Node.js version,
# uncomment these lines to roll back to a previous version

# Remove current Node.js version:
#sudo apt-get -y purge nodejs
#sudo rm -rf /usr/lib/node_modules/npm/lib
#sudo rm -rf //etc/apt/sources.list.d/nodesource.list

# Install Node.js Version desired (i.e. v13)
# More info: https://github.com/nodesource/distributions/blob/master/README.md#debinstall
#curl -sL https://deb.nodesource.com/setup_13.x | sudo -E bash -
#sudo apt-get install -y nodejs


php80

# Remove Node.js v12.x:va
sudo apt-get -y purge nodejs
sudo rm -rf /usr/lib/node_modules/npm/lib
sudo rm -rf /etc/apt/sources.list.d/nodesource.list

# Install Node.js v11.x
#curl -sL https://deb.nodesource.com/setup_11.x | sudo -E bash -
#sudo apt-get install -y nodejs

# Install Node.js v12.x
curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
sudo apt-get install -y nodejs

sudo cp /var/www/wordy/Homestead/nginx/wordy.test /etc/nginx/sites-available/wordy.test

sudo systemctl restart postgresql

psql -d wordy -h homestead -U homestead -e -c "CREATE USER wordy_dbuser WITH PASSWORD 'wordytest';"
psql -d wordy -h homestead -U homestead -e -c "GRANT ALL PRIVILEGES ON DATABASE wordy to wordy_dbuser;"

sudo service php8.0-fpm restart
sudo systemctl restart nginx

cd /
wget https://get.symfony.com/cli/installer -O - | bash
mv /home/vagrant/.symfony5/bin/symfony /usr/local/bin/symfony

cd /var/www/wordy/
composer install

symfony console doctrine:migrations:migrate

yarn install
npm run dev

php bin/console assets:install

