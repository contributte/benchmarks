#!/usr/bin/env bash

DIR=`dirname "$0"`
SRC_DIR="$DIR/../src"
COMPOSER_OPTIONS="--prefer-dist --no-interaction --optimize-autoloader --no-dev -v"

echo "# Update $SRC_DIR/NetteDatabase/v2.0"
composer update -d "$SRC_DIR/NetteDatabase/v2.0/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/NetteDatabase/v2.1"
composer update -d "$SRC_DIR/NetteDatabase/v2.1/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/NetteDatabase/v2.2"
composer update -d "$SRC_DIR/NetteDatabase/v2.2/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/NetteDatabase/v2.3"
composer update -d "$SRC_DIR/NetteDatabase/v2.3/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/NetteDatabase/v2.4"
composer update -d "$SRC_DIR/NetteDatabase/v2.4/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/NetteDatabase/master"
composer update -d "$SRC_DIR/NetteDatabase/master/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/NextrasOrm/v1.0"
composer update -d "$SRC_DIR/NextrasOrm/v1.0/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/YetORM/v8.0"
composer update -d "$SRC_DIR/YetORM/v8.0/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/LeanMapper/v2.0"
composer update -d "$SRC_DIR/LeanMapper/v2.0/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/NotORM/master"
composer update -d "$SRC_DIR/NotORM/master/" $COMPOSER_OPTIONS

echo "# Update $SRC_DIR/Doctrine/v2.4"
composer update -d "$SRC_DIR/Doctrine/v2.4/" $COMPOSER_OPTIONS
