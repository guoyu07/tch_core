# TCH MVC框架简介

## 目的

提供基于Discuz插件模式的PHP MVC开发框架;


## 哲学

独立的折腾出一款框架是比较快的,但要确定它的特性很难.所以正常情况下,框架是脱胎于具体的应用的.

一款成功的应用程序会带来大量开发人员的追随,而支撑该应用的框架,即便很简洁甚至很简单,都产生了极强的生命力.

这种生命力的源泉,是应用程序赋予的.

Discuz无疑是一款成功的应用程序.大量的开发人员为其编写插件和模板,产生了巨大的价值.

### Discuz原生

即Discuz已有的机制不破坏,特性几乎不额外增加;只是想换一种代码组织结构.所以也是简洁的.

### MVC

MVC不是我们追求的目标,清晰的代码结构和高可复用性代码才是.MVC只是一种手段.

在创业团队中,尤其应该有这样的意识,否则代码会很快陷入腐朽的境地.

Discuz中也有有比较系统的框架,只是没有定义出类似MVC的开发模式.

这套TCH框架是否狗尾续貂,就看开发者的评价了.

## 从哪开始

学习一门框架据说既令人生畏，又令人兴奋.

对于TCH,你只需记住M - V - C三个字即可,因为它并没有提供额外的特性,只是约定了代码放到对应的位置而已.

tch_core插件作为框架的提供源.其他插件通过引用tch_core的起步文件_bootstrap.php即可.

前台的引用(如 help.inc.php):

```php
require dirname(__FILE__) . '/_bootstrap.php';

$router = new TCH_Core_Router();
//$router->run(); //不传参代表访问默认的控制器和方法 main/index
$router->run('article', 'getHelp');

```

后台与前台的入口文件略有不同(如 admincp.inc.php):

```php
require dirname(__FILE__) . '/_bootstrap.php';

$router = new TCH_Core_AdminRouter();
$router->run('main');

```

