<?php
namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Symbol;
use App\Repository\SymbolRepository;

/**
 * Class ExchangeController
 *
 * @package App\Controller\API
 */
class ExchangeController extends AbstractController {
	/**
	 * https://codereviewvideos.com/course/symfony-basics/video/how-to-get-the-request-query-parameters-in-symfony
	 *
	 * @param Request $request
	 * @param string $code
	 *
	 * @return mixed
	 */
	public function Index (Request $request, $code) {
		/**
		 * @var SymbolRepository $repository
		 */
		$repository = $this->getDoctrine()->getRepository(Symbol::class);

		$symbol = $repository->findOneByCode($code);

		if ($symbol == null)
			return $this->json(array('status' => 404));

		return $this->json(array(
			'status' => 200,
			'symbol' => $symbol
		));
	}
}