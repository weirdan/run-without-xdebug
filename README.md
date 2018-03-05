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
