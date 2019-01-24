<?php
namespace ViewModels;

use Quark\IQuarkViewResource;

use Quark\QuarkView;

use Quark\ViewResources\jQuery\jQueryCore;
use Quark\ViewResources\Quark\QuarkPresence\QuarkPresence;

/**
 * Class LayoutView
 *
 * @package ViewModels
 */
class LayoutView implements ICEView {
	use ViewBehavior;

	/**
	 * @return string
	 */
	public function View () {
		return 'Layout';
	}

	/**
	 * @return IQuarkViewResource|string
	 */
	public function ViewStylesheet () {
		return $this->ThemeResource('/static/layout.css');
	}

	/**
	 * @return IQuarkViewResource|string
	 */
	public function ViewController () {
		return $this->ThemeResource('/static/layout.js');
	}

	/**
	 * @return IQuarkViewResource[]
	 */
	public function ViewResources () {
		return array(
			new jQueryCore(),
			new QuarkPresence()
		);
	}

	/**
	 * @return string
	 */
	public function CETitle () {
		/**
		* @var QuarkView|ICEView $child
		*/
		$child = $this->Child();

		return $child->CETitle();
	}
}