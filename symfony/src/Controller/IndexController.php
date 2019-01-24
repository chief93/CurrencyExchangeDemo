<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Symbol;
use App\Repository\SymbolRepository;

/**
 * Class IndexController
 *
 * @package App\Controller
 */
class IndexController extends AbstractController {
	/**
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function Index (Request $request) {
		/**
		 * @var SymbolRepository $repository
		 */
		$repository = $this->getDoctrine()->getRepository(Symbol::class);

		return $this->render('Index.html.twig', array(
			'last_update' => $repository->LastUpdate()
		));
	}
}