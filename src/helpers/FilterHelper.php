<?php

namespace yii2lab\designPattern\helpers;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;
use yii2lab\helpers\Helper;
use yii2lab\designPattern\interfaces\FilterInterface;

class FilterHelper {
	
	/**
	 * @param $config
	 * @param $data
	 *
	 * @return mixed
	 * @throws ServerErrorHttpException
	 * @throws InvalidConfigException
	 */
	public static function run($config, $data) {
		$config = Helper::isEnabledComponent($config);
		if(!$config) {
			return null;
		}
		$filterInstance = self::create($config);
		$data = $filterInstance->run($data);
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
	 * @param      $config
	 *
	 * @return FilterInterface
	 * @throws ServerErrorHttpException
	 * @throws InvalidConfigException
	 */
	public static function create($config) {
		/** @var FilterInterface $object */
		$object = Helper::createObject($config, [], FilterInterface::class);
		return $object;
	}
	
}
