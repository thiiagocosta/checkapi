#!/bin/bash

echo -e "\nCheckAPI Install - Start\n"

# Download Composer
if [ ! -f composer.phar ]; then
  echo -e "Download Composer:"
  curl https://getcomposer.org/composer-stable.phar --output composer.phar
else
  echo -e "Composer.phar exist."
fi

# Install Composer
if [ ! -d "vendor" ]; then
  echo -e "\nComposer Install:"
  php composer.phar install
else
  echo "vendor/ exist."
fi

# Create Folder Project
if [ ! -d "projects" ]; then
  echo -e "Create folder /projects."
  mkdir projects
else
  echo "project/ exist."
fi

# Create Config File
if [ ! -f config.php ]; then
  cp config_exemple.php config.php
  echo -e "\nFile config.php created!\n"
else
  echo -e "config.php exist.\n"
fi

echo -e "CheckAPI Install - Finished\n"