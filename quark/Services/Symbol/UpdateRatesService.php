<?php
namespace Services\Symbol;

use Quark\IQuarkTask;

use Quark\Quark;
use Quark\QuarkCollection;
use Quark\QuarkDate;
use Quark\QuarkModel;

use Middleware\ExchangeRates\ExchangeRates;
use Middleware\ExchangeRates\ExchangeRatesSymbol;

use Models\Symbol;

/**
 * Class UpdateRatesService
 *
 * @package Services\Symbol
 */
class UpdateRatesService implements IQuarkTask {
	/**
	 * @param int $argc
	 * @param array $argv
	 *
	 * @return mixed
	 */
	public function Task ($argc, $argv) {
		$exchange = new ExchangeRates(CE_EXCHANGE_RATES);
		$latest = $exchange->Latest(ExchangeRatesSymbol::EUR, array(
			ExchangeRatesSymbol::USD
		));

		/**
		 * @var QuarkCollection|Symbol[] $symbols
		 */
		$symbols = QuarkModel::Find(new Symbol());

		foreach ($latest as $item) {
			/**
			 * @var QuarkModel|Symbol $symbol
			 */
			$symbol = $symbols->SelectOne(array(
				'code' => $item->Code()
			));

			if ($symbol == null) {
				$symbol = new QuarkModel(new Symbol());

				$symbol->code = $item->Code();
				$symbol->rate = $item->Rate();

				if (!$symbol->Create())
					Quark::Log('Can not create symbol "' . $symbol->code . '" with rate value of ' . $symbol->rate, Quark::LOG_WARN);
			}
			else {
				$symbol->rate = $item->Rate();
				$symbol->date_updated = QuarkDate::GMTNow();

				if (!$symbol->Save())
					Quark::Log('Can not update symbol "' . $symbol->code . '" with rate value of ' . $symbol->rate, Quark::LOG_WARN);
			}
		}
	}
}