Установка
===

Устанавливаем зависимость:

```
composer require yii2lab/yii2-design-pattern
```

Создаем полномочие:

```
oExamlpe
```

Объявляем frontend модуль:

```php
return [
	'modules' => [
		// ...
		'design-pattern' => 'yii2lab\DesignPattern\frontend\Module',
		// ...
	],
];
```

Объявляем backend модуль:

```php
return [
	'modules' => [
		// ...
		'design-pattern' => 'yii2lab\DesignPattern\backend\Module',
		// ...
	],
];
```

Объявляем api модуль:

```php
return [
	'modules' => [
		// ...
		'DesignPattern' => 'yii2lab\DesignPattern\api\Module',
		// ...
		'components' => [
            'urlManager' => [
                'rules' => [
                    ...
                   ['class' => 'yii\rest\UrlRule', 'controller' => ['{apiVersion}/design-pattern' => 'design-pattern/default']],
                    ...
                ],
            ],
        ],
	],
];
```

Объявляем консольный модуль:

```php
return [
	'modules' => [
		// ...
		'design-pattern' => 'yii2lab\DesignPattern\console\Module',
		// ...
	],
];
```

Объявляем домен:

```php
return [
	'components' => [
		// ...
		'DesignPattern' => 'yii2lab\DesignPattern\domain\Domain',
		// ...
	],
];
```
