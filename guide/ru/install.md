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
		'design-pattern' => 'yii2lab\design-pattern\frontend\Module',
		// ...
	],
];
```

Объявляем backend модуль:

```php
return [
	'modules' => [
		// ...
		'design-pattern' => 'yii2lab\design-pattern\backend\Module',
		// ...
	],
];
```

Объявляем api модуль:

```php
return [
	'modules' => [
		// ...
		'design-pattern' => 'yii2lab\design-pattern\api\Module',
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
		'design-pattern' => 'yii2lab\design-pattern\console\Module',
		// ...
	],
];
```

Объявляем домен:

```php
return [
	'components' => [
		// ...
		'design-pattern' => 'yii2lab\design-pattern\domain\Domain',
		// ...
	],
];
```
