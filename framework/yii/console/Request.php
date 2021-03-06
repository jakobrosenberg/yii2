<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\console;

/**
 *
 * @property array $params The command line arguments. It does not include the entry script name.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Request extends \yii\base\Request
{
	private $_params;

	/**
	 * Returns the command line arguments.
	 * @return array the command line arguments. It does not include the entry script name.
	 */
	public function getParams()
	{
		if (!isset($this->_params)) {
			if (isset($_SERVER['argv'])) {
				$this->_params = $_SERVER['argv'];
				array_shift($this->_params);
			} else {
				$this->_params = [];
			}
		}
		return $this->_params;
	}

	/**
	 * Sets the command line arguments.
	 * @param array $params the command line arguments
	 */
	public function setParams($params)
	{
		$this->_params = $params;
	}

	/**
	 * Resolves the current request into a route and the associated parameters.
	 * @return array the first element is the route, and the second is the associated parameters.
	 */
	public function resolve()
	{
		$rawParams = $this->getParams();
		if (isset($rawParams[0])) {
			$route = $rawParams[0];
			array_shift($rawParams);
		} else {
			$route = '';
		}

		$params = [];
		foreach ($rawParams as $param) {
			if (preg_match('/^--(\w+)(=(.*))?$/', $param, $matches)) {
				$name = $matches[1];
				$params[$name] = isset($matches[3]) ? $matches[3] : true;
			} else {
				$params[] = $param;
			}
		}

		return [$route, $params];
	}
}
