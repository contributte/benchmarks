#!/usr/bin/env sh
DIR=`dirname "$0"`
SRC_DIR="$DIR/../src"

php "$SRC_DIR/NetteDatabase/v2.0/run-employees.php"
php "$SRC_DIR/NetteDatabase/v2.1/run-employees.php"
php "$SRC_DIR/NetteDatabase/v2.2/run-employees.php"
php "$SRC_DIR/NetteDatabase/v2.3/run-employees.php"
php "$SRC_DIR/NetteDatabase/v2.4/run-employees.php"
php "$SRC_DIR/NetteDatabase/master/run-employees.php"
php "$SRC_DIR/NextrasOrm/v1.0/run-employees.php"
php "$SRC_DIR/YetORM/v8.0/run-employees.php"
php "$SRC_DIR/LeanMapper/v2.0/run-employees.php"
php "$SRC_DIR/NotORM/master/run-employees.php"
php "$SRC_DIR/Doctrine/v2.4/run-employees.php"
