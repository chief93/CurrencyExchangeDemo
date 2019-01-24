<?php
namespace App\Middleware\ExchangeRates;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

/**
 * Class ExchangeRates
 *
 * @package App\Middleware\ExchangeRates
 */
class ExchangeRates {
	const API = 'https://api.exchangeratesapi.io';

	/**
	 * @var Client $_client
	 */
	private $_client;

	/**
	 * @var LoggerInterface $_logger
	 */
	private $_logger;

	/**
	 * @param LoggerInterface $logger
	 */
	public function __construct (LoggerInterface $logger) {
		$this->_client = new Client();
		$this->_logger = $logger;
	}

	/**
	 * @param string $base = ExchangeRatesSymbol::EUR
	 * @param string[] $symbols = null
	 *
	 * @return ExchangeRatesSymbol[]
	 */
	public function Latest ($base = ExchangeRatesSymbol::EUR, $symbols = null) {
		$out = array();

		$rawResponse = $this->_client->get(self::API . '/latest?base=' . $base . (is_array($symbols) ? '&symbols=' . implode(',', $symbols) : ''));
		$response = \json_decode($rawResponse->getBody());

		if (!$response || !isset($response->rates) || !is_object($response->rates)) {
			$this->_logger->warning('Could not retrieve exchange rates');
			$this->_logger->warning(print_r($response, true));

			return $out;
		}

		foreach ($response->rates as $symbol => &$rate)
			$out[] = new ExchangeRatesSymbol($symbol, $rate);

		return $out;
	}
}