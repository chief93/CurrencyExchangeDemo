<?php
namespace App\Command\Symbol;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Middleware\ExchangeRates\ExchangeRates;
use App\Middleware\ExchangeRates\ExchangeRatesSymbol;
use App\Entity\Symbol;
use App\Repository\SymbolRepository;

/**
 * Class UpdateRatesCommand
 *
 * @package App\Command\Symbol
 */
class UpdateRatesCommand extends Command {
	/**
	 * @var string $defaultName
	 */
	protected static $defaultName = 'symbol:update-rates';

	/**
	 * @var ExchangeRates $_exchange
	 */
	private $_exchange;

	/**
	 * @var EntityManagerInterface $_doctrine
	 */
	private $_doctrine;

	/**
	 * @param ExchangeRates $exchange
	 * @param EntityManagerInterface $doctrine
	 */
	public function __construct (ExchangeRates $exchange, EntityManagerInterface $doctrine) {
		parent::__construct();

		$this->_exchange = $exchange;
		$this->_doctrine = $doctrine;
	}

	/**
	 * Configures the current command.
	 */
	protected function configure () {

	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return mixed
	 */
	protected function execute (InputInterface $input, OutputInterface $output) {
		$latest = $this->_exchange->Latest(ExchangeRatesSymbol::EUR, array(
			ExchangeRatesSymbol::USD
		));

		/**
		 * @var SymbolRepository $repository
		 */
		$repository = $this->_doctrine->getRepository(Symbol::class);

		$symbols = $repository->findAll();

		foreach ($latest as $item) {
			$symbol = null;

			foreach ($symbols as $model) {
				if ($model->getCode() != $item->Code()) continue;

				$symbol = $model;
				break;
			}

			if ($symbol == null) {
				$symbol = new Symbol();

				$symbol->setCode($item->Code());
				$symbol->setRate($item->Rate());
			}
			else {
				$symbol->setRate($item->Rate());
				$symbol->setDateUpdated(gmdate('Y-m-d H:i:s'));
			}

			$this->_doctrine->persist($symbol);
		}

		$this->_doctrine->flush();
	}
}