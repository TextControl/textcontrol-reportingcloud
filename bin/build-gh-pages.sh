#!/usr/bin/env bash

LIB_PATH_COMPOSER=~/.composer/vendor/bin
LIB_PATH_PACKAGE=~/lib/textcontrol/textcontrol-reportingcloud
LIB_PATH_GH_PAGES=~/lib/textcontrol/textcontrol-reportingcloud-gh-pages

# ----------------------------------------------------------------------------------------------------------------------

# Download and Install PHP Documentor

cd $LIB_PATH_COMPOSER || exit

rm phpdoc

wget -q https://github.com/phpDocumentor/phpDocumentor/releases/download/v3.4.1/phpDocumentor.phar -O phpdoc

chmod +x phpdoc

# ----------------------------------------------------------------------------------------------------------------------

# Clone Repository and Build API Documentation

rm -fr $LIB_PATH_GH_PAGES

git clone git@github.com:TextControl/textcontrol-reportingcloud.git --branch gh-pages $LIB_PATH_GH_PAGES

cd $LIB_PATH_GH_PAGES || exit

rm -fr docs-api

mkdir -p docs-api

$LIB_PATH_COMPOSER/phpdoc run --cache-folder /tmp/ --directory $LIB_PATH_PACKAGE/src --target docs-api

# ----------------------------------------------------------------------------------------------------------------------

# Commit and Push API Documentation

git add .

git commit -am"Updated API documentation"

git push origin gh-pages

# ----------------------------------------------------------------------------------------------------------------------