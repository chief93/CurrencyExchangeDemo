<?php
namespace ViewModels;

use Quark\IQuarkViewModel;
use Quark\IQuarkViewModelInLocalizedTheme;
use Quark\IQuarkViewModelWithComponents;
use Quark\IQuarkViewModelWithResources;

/**
 * Interface ICEView
 *
 * @package ViewModels
 */
interface ICEView extends IQuarkViewModel, IQuarkViewModelInLocalizedTheme, IQuarkViewModelWithResources, IQuarkViewModelWithComponents {
	/**
	 * @return string
	 */
	public function CETitle();
}