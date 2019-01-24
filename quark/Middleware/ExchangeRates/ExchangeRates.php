<?php
namespace Middleware\ExchangeRates;

use Quark\IQuarkExtension;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkHTTPClient;
use Quark\QuarkJSONIOProcessor;

/**
 * Class ExchangeRates
 *
 * @package Middleware\ExchangeRates
 */
class ExchangeRates implements IQuarkExtension {
	const API = 'https://api.exchangeratesapi.io';

	/**
	 * @var ExchangeRatesConfig $_config
	 */
	private $_config;

	/**
	 * @param string $config
	 */
	public function __construct ($config) {
		$this->_config = Quark::Config()->Extension($config);
	}

	/**
	 * @param string $base = ExchangeRatesSymbolvEUR
	 * @param string[] $symbols = null
	 *
	 * @return ExchangeRatesSymbol[]
	 */
	public function Latest ($base = ExchangeRatesSymbol::EUR, $symbols = null) {
		$response = QuarkHTTPClient::To(self::API . '/latest?base=' . $base . (is_array($symbols) ? '&symbols=' . implode(',', $symbols) : ''), QuarkDTO::ForGET(), new QuarkDTO(new QuarkJSONIOProcessor()));

		$out = array();

		if (!$response || !isset($response->rates) || !is_object($response->rates)) {
			Quark::Log('Could not retrieve exchange rates', Quark::LOG_WARN);
			Quark::Trace($response);

			return $out;
		}

		foreach ($response->rates as $symbol => &$rate)
			$out[] = new ExchangeRatesSymbol($symbol, $rate);

		return $out;
	}
}