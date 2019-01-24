<?php
namespace Services;

use Quark\IQuarkGetService;

use Quark\QuarkDTO;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Symbol;

use ViewModels\IndexView;
use ViewModels\LayoutView;

/**
 * Class IndexService
 *
 * @package Services
 */
class IndexService implements IQuarkGetService {
	/**
	 * @param QuarkDTO $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		return QuarkView::InLayout(new IndexView(), new LayoutView(), array(
			'last_update' => Symbol::LastUpdate()
		));
	}
}