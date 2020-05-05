Chirripo Launcher
=================

Launcher for [Chirripo](https://github.com/chirripo/chirripo) project.

# Instructions

- Install either globally (`composer global require chirripo/chirripo-launcher`) or by using cgr ([https://packagist.org/packages/consolidation/cgr](https://packagist.org/packages/consolidation/cgr))
- Now the chirripo binary is available globally. Make sure your global vendor binaries directory is in your $PATH environment variable, you can get its location with the following command:
```
php composer.phar global config bin-dir --absolute
```
- Use Chirripo by simply invoking `chirripo` command from any project using chirripo