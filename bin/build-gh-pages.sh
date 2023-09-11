#!/usr/bin/env bash

LIB_PATH_COMPOSER=~/.composer/vendor/bin
LIB_PATH_PACKAGE=~/lib/textcontrol/textcontrol-reportingcloud
LIB_PATH_BRANCH=~/lib/textcontrol/textcontrol-reportingcloud-gh

# ----------------------------------------------------------------------------------------------------------------------

rm $LIB_PATH_COMPOSER/phpdoc

wget --quiet https://github.com/phpDocumentor/phpDocumentor/releases/download/v3.4.1/phpDocumentor.phar \
      -O $LIB_PATH_COMPOSER/phpdoc

chmod +x $LIB_PATH_COMPOSER/phpdoc

# ----------------------------------------------------------------------------------------------------------------------

rm -fr $LIB_PATH_BRANCH

git clone git@github.com:TextControl/textcontrol-reportingcloud.git --branch gh-pages $LIB_PATH_BRANCH

# ----------------------------------------------------------------------------------------------------------------------

rm -fr $LIB_PATH_BRANCH/docs-api

mkdir -p $LIB_PATH_BRANCH/docs-api

$LIB_PATH_COMPOSER/phpdoc run            \
    --cache-folder /tmp/                 \
    --directory ${LIB_PATH_PACKAGE}/src  \
    --target $LIB_PATH_BRANCH/docs-api   \
    --template clean

cd $LIB_PATH_BRANCH || exit

# ----------------------------------------------------------------------------------------------------------------------

git add .

git commit -am"Updated API documentation"

git push origin gh-pages

# ----------------------------------------------------------------------------------------------------------------------