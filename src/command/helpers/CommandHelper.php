<?php

namespace yii2lab\designPattern\command\helpers;

use yii\web\ServerErrorHttpException;
use yii2lab\designPattern\command\interfaces\CommandInterface;
use yii2lab\helpers\Helper;
use yii2mod\helpers\ArrayHelper;

class CommandHelper {
	
	/**
	 * @param      $definition
	 *
	 * @return mixed
	 * @throws ServerErrorHttpException
	 * @throws \yii\base\InvalidConfigException
	 */
	public static function run($definition) {
		$definition = Helper::isEnabledComponent($definition);
		if(!$definition) {
			return null;
		}
		$object = self::create($definition);
		if(method_exists($object, 'isEnabled') && !$object->isEnabled()) {
			return null;
		}
		$result = $object->run();
		return [
			'object' => $object,
			'config' => $definition,
			'result' => $result,
		];
	}
	
	/**
	 * @param array $configList
	 *
	 * @return array
	 * @throws ServerErrorHttpException
	 * @throws \yii\base\InvalidConfigException
	 */
	public static function runAll(array $configList) {
		if(empty($configList)) {
			return [];
		}
		$result = [];
		$configList = ArrayHelper::toArray($configList);
		foreach($configList as $config) {
			$config = Helper::isEnabledComponent($config);
			if($config) {
				$result[] = self::run($config);
			}
		}
		return $result;
	}
	
	/**
	 * @param      $definition
	 *
	 * @return CommandInterface
	 * @throws ServerErrorHttpException
	 * @throws \yii\base\InvalidConfigException
	 */
	public static function create($definition) {
		/** @var CommandInterface $object */
		$object = Helper::createObject($definition, [], CommandInterface::class);
		return $object;
	}
	
}
