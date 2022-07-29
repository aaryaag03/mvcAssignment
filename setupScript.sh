#! /bin/bash

if [[ -f "config/config.php" ]]; then
	
	echo "Starting server at port 8000"
	cd public
	php -S localhost:8000

else
	echo "Create a new database in your mysql"	
	read -n 1 -r -s -p $'Press enter after creating new database has been created\n'

	echo "Enter your details"

	$DB_HOST 
	echo "Enter DB_HOST:"
	read DB_HOST

	$DB_PORT
	echo "Enter DB_PORT:"
	read DB_PORT 

	$DB_NAME 
	echo "Enter DB_NAME:"
	read DB_NAME 

	$DB_USERNAME
	echo "Enter DB_USERNAME:"
	read DB_USERNAME

	$DB_PASSWORD
	echo "Enter DB_PASSWORD:"
	read DB_PASSWORD

	touch config/config.php
	echo "<?php">>config/config.php
	echo "$DB_HOST= "$DB_HOST";">>config/config.php
	echo "$DB_PORT= "$DB_PORT";">>config/config.php
	echo "$DB_NAME= "$DB_NAME";">>config/config.php
	echo "$DB_USERNAME= "$DB_USERNAME";">>config/config.php
	echo '$DB_PASSWORD= '$DB_PASSWORD';'>>config/config.php
	echo '?>'>>config/config.php

	mysql -u $DB_USERNAME -p $DB_NAME<database.sql

	composer install
	composer dumpautoload
	echo "Starting server at port 8000"
	cd public
	php -S localhost:8000
fi

