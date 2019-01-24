<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkModelWithDataProvider;
use Quark\IQuarkStrongModel;

use Quark\QuarkDate;
use Quark\QuarkModel;
use Quark\QuarkModelBehavior;

/**
 * Class Symbol
 *
 * @property int $id
 * @property string $code
 * @property float $rate
 * @property QuarkDate $date_updated
 *
 * @package Models
 */
class Symbol implements IQuarkModel, IQuarkStrongModel, IQuarkModelWithDataProvider {
	use QuarkModelBehavior;

	/**
	 * @return string
	 */
	public function DataProvider () {
		return CE_DATA;
	}

	/**
	 * @return mixed
	 */
	public function Fields () {
		return array(
			$this->DataProviderPk(),
			'code' => '',
			'rate' => 0.0,
			'date_updated' => QuarkDate::GMTNow()
		);
	}

	/**
	 * @return mixed
	 */
	public function Rules () {
		// TODO: Implement Rules() method.
	}

	/**
	 * @return QuarkDate
	 */
	public static function LastUpdate () {
		/**
		 * @var QuarkModel|Symbol $symbol
		 */
		$symbol = QuarkModel::FindOne(new Symbol(), array(), array(
			QuarkModel::OPTION_SORT => array('date' => -1)
		));

		return $symbol == null ? null : $symbol->date_updated;
	}
}