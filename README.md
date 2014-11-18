Doctrine Functions
==================

This package contains some doctrine functions

### String functions

* `INSTR(exp1, exp2)` - [documentation](http://dev.mysql.com/doc/refman/5.0/en/string-functions.html#function_instr)
* `FIELD(exp1, exp2, exp3, exp4...)` - [documentation](http://dev.mysql.com/doc/refman/5.0/en/string-functions.html#function_field)

### DateTime functions

* `DATE_FORMAT(field, '%format%')` - [documentation](http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_date-format)

### Math functions

* `RAND()` - [documentation](http://dev.mysql.com/doc/refman/5.0/en/mathematical-functions.html#function_rand). Remember, you can not use parameters in this function.
* `RANDP(12345)` - [documentation](http://dev.mysql.com/doc/refman/5.0/en/mathematical-functions.html#function_rand). This is still RAND() MySQL function, but you must use a number parameter in it.


Installation
------------

Just add the package to your `composer.json`

```json
{
    "require": {
        "iakumai/doctrine-functions": "dev-master"
    }
}
```

Integration
-----------

### 1) Doctrine Only

According to the [Doctrine documentation](http://docs.doctrine-project.org/en/latest/cookbook/dql-user-defined-functions.html) you can register the functions in this package this way.

```php
<?php
$config = new \Doctrine\ORM\Configuration();
$config->addCustomDatetimeFunction('instr', 'IAkumaI\DQL\Str\Instr');
?>
```

### 2) Using Symfony 2

With symfony 2 you can register yout functions in the `config.yml` file.

```yaml
doctrine:
    orm:
        entity_managers:
            default:
                dql:
                    datetime_functions:
                        instr: IAkumaI\DQL\Str\Instr
```

Usage
-----

Simple example, usage a DateFormat function:

```php
<?php
use Doctrine\ORM\EntityManager;

// EntityManager
$em->createQuery("SELECT DATE_FORMAT(e.date, '%d.%m.%Y') as df FROM YourBundle:Ent e");
?>
```

This way you can use DQL function in ORDER statement. For example, order by RAND():

```php
<?php
use Doctrine\ORM\EntityManager;

// EntityManager
$em->createQuery("SELECT e, RAND() as HIDDEN rand FROM YourBundle:Ent e ORDER BY rand");
?>
```
