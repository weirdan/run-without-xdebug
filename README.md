[![linux build](https://img.shields.io/travis/weirdan/run-without-xdebug/master.svg?label=linux+build)](https://travis-ci.org/weirdan/run-without-xdebug)
![license](https://img.shields.io/github/license/weirdan/run-without-xdebug.svg)
![php](https://img.shields.io/packagist/php-v/weirdan/run-without-xdebug.svg?colorB=8892BF&label=php)

# Intro
This is a simple CLI utility to run any PHP script with XDebug disabled. XDebug, while providing many useful features, results in considerable performance hit. This is especially useful to run big unit test suites when you *don't* need code coverage (like, when fixing a bug). 

# Installation
```
composer global require weirdan/run-without-xdebug:@dev
```

# Usage
```
php-noxdebug `which phpunit` --testdox
```
