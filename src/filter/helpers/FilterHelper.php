<?php

namespace yii2lab\designPattern\filter\helpers;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;
use yii2lab\designPattern\filter\interfaces\FilterInterface;
use yii2lab\helpers\ClassHelper;
use yii2lab\helpers\Helper;

/**
 * Class FilterHelper
 *
 * @package yii2lab\designPattern\filter\helpers
 *
 * @deprecated use yii2lab\designPattern\scenario\ScenarioHelper
 */
class FilterHelper {
	
	/**
	 * @param $definition
	 * @param $data
	 *
	 * @return mixed
	 * @throws ServerErrorHttpException
	 * @throws InvalidConfigException
	 */
	public static function run($definition, $data) {
		$definition = Helper::isEnabledComponent($definition);
		if(!$definition) {
			return $data;
		}
		$object = self::create($definition);
		if(method_exists($object, 'isEnabled') && !$object->isEnabled()) {
			return $data;
		}
		$data = $object->run($data);
		return $data;
	}
	
	/**
	 * @param array $filters
	 * @param       $data
	 *
	 * @return mixed
	 * @throws ServerErrorHttpException
	 * @throws InvalidConfigException
	 */
	public static function runAll(array $filters, $data) {
		if(empty($filters)) {
			return $data;
		}
		$filters = ArrayHelper::toArray($filters);
		foreach($filters as $config) {
			$config = Helper::isEnabledComponent($config);
			if($config) {
				$data = self::run($config, $data);
			}
		}
		return $data;
	}
	
	/**
	 * @param      $definition
	 *
	 * @return FilterInterface
	 * @throws ServerErrorHttpException
	 * @throws InvalidConfigException
	 */
	public static function create($definition) {
		/** @var FilterInterface $object */
		$object = ClassHelper::createObject($definition, [], FilterInterface::class);
		return $object;
	}
	
}
