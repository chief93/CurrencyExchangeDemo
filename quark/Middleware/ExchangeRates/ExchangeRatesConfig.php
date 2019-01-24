<?php
namespace Middleware\ExchangeRates;

use Quark\IQuarkExtension;
use Quark\IQuarkExtensionConfig;

/**
 * Class ExchangeRatesConfig
 *
 * @package Middleware\ExchangeRates
 */
class ExchangeRatesConfig implements IQuarkExtensionConfig {
	/**
	 * @var string $_name = ''
	 */
	private $_name = '';

	/**
	 * @param string $name
	 */
	public function Stacked ($name) {
		$this->_name = $name;
	}

	/**
	 * @return string
	 */
	public function ExtensionName () {
		return $this->_name;
	}

	/**
	 * @param object $ini
	 *
	 * @return mixed
	 */
	public function ExtensionOptions ($ini) {
		// TODO: Implement ExtensionOptions() method.
	}

	/**
	 * @return IQuarkExtension
	 */
	public function ExtensionInstance () {
		return new ExchangeRates($this->_name);
	}
}