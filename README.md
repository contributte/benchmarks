# DBAL(s) BENCHMARK

Database libraries benchmark based on Employees Sample Database

[![Build Status](https://travis-ci.org/f3l1x/dbals-benchmark.svg)](https://travis-ci.org/f3l1x/dbals-benchmark)

## Prolog

The task is:
> Select 500 employees from the Employees database, for each of them show all of their salaries and all the departments they belong to.

## Thanks to

Forked from @dg (https://github.com/dg/db-benchmark), thank you.

Idea by @tharos (http://forum.nette.org/cs/viewtopic.php?pid=106521#p106521), thank you.

## Libraries

### ORM

- Doctrine2 [~2.4]
- LeanMapper [~2.0]
- NextrasOrm [~1.0]
- YetORM [~8.0]

### ActiveRecord

- Nette Database [~2.0, ~2.1, ~2.2, ~2.3, master]
- NotORM [master]

## Usage

- Run `installall` - it installs all dependencies for each library
- Update `$config` in `bootstrap.php` - database driver / dbname / user / password
- Run `composer -d import install` - it installs dependencies for import script
- Run `php import/import.php` - it imports all needed SQL code
- Run `testall` or reach library individually `php run-employees.php`
