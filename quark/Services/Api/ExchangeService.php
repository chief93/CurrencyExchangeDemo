<?php
namespace Services\Api;

use Quark\IQuarkGetService;
use Quark\IQuarkIOProcessor;
use Quark\IQuarkServiceWithCustomProcessor;

use Quark\QuarkDTO;
use Quark\QuarkJSONIOProcessor;
use Quark\QuarkModel;
use Quark\QuarkSession;

use Models\Symbol;

/**
 * Class ExchangeService
 *
 * @package Services\Api
 */
class ExchangeService implements IQuarkGetService, IQuarkServiceWithCustomProcessor {
	/**
	 * @param QuarkDTO $request
	 *
	 * @return IQuarkIOProcessor
	 */
	public function Processor (QuarkDTO $request) {
		return new QuarkJSONIOProcessor();
	}

	/**
	 * @param QuarkDTO $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		/**
		 * @var QuarkModel|Symbol $symbol
		 */
		$symbol = QuarkModel::FindOne(new Symbol(), array(
			'code' => $request->URI()->Route(2)
		));

		if ($symbol == null)
			return array('status' => 404);

		return array(
			'status' => 200,
			'symbol' => $symbol->Extract()
		);
	}
}