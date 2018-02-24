Demo Yii2 translated behavior
===============================

This is a demo project for [Yii2 translated behavior](https://github.com/LAV45/yii2-translated-behavior) extensions

You can see it [https://yii2-translated-behavior.lav45.com](https://yii2-translated-behavior.lav45.com)

The entrance to the [admin](https://yii2-translated-behavior.lav45.com/admin) panel:
login/password: admin/admin

Install
-------

```bash
~$ git clone https://github.com/yiisoft/yii2.git
~$ git clone https://github.com/LAV45/yii2-translated-behavior-demo.git
~$ cd yii2-translated-behavior-demo

~$ composer install --prefer-dist --no-interaction --optimize-autoloader --no-dev
~$ php init --env=prod --overwrite=n
~$ php yii migrate/up all --interactive=0
~$ php yii user/create admin admin
```
