<?php
namespace App\Middleware\ExchangeRates;

/**
 * Class ExchangeRatesSymbol
 *
 * @package App\Middleware\ExchangeRates
 */
class ExchangeRatesSymbol {
	const EUR = 'EUR';
	const USD = 'USD';

	/**
	 * @var string $_code = ''
	 */
	private $_code = '';

	/**
	 * @var float $_rate = 0.0
	 */
	private $_rate = 0.0;

	/**
	 * @param string $code = ''
	 * @param float $rate = 0.0
	 */
	public function __construct ($code = '', $rate = 0.0) {
		$this->Code($code);
		$this->Rate($rate);
	}

	/**
	 * @param string $code
	 *
	 * @return string
	 */
	public function Code ($code = '') {
		if (func_num_args() != 0)
			$this->_code = $code;

		return $this->_code;
	}

	/**
	 * @param float $rate = 0.0
	 *
	 * @return float
	 */
	public function Rate ($rate = 0.0) {
		if (func_num_args() != 0)
			$this->_rate = $rate;

		return $this->_rate;
	}
}