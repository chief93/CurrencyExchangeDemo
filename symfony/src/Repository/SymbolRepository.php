<?php
namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use App\Entity\Symbol;

/**
 * Class SymbolRepository
 *
 * @package App\Repository
 */
class SymbolRepository extends ServiceEntityRepository {
	/**
	 * @param RegistryInterface $registry
	 */
	public function __construct (RegistryInterface $registry) {
		parent::__construct($registry, Symbol::class);
	}

	/**
	 * @param string $code
	 *
	 * @return Symbol
	 */
	public function findOneByCode ($code) {
		return $this->createQueryBuilder('s')
			->andWhere('s.code = :code')
			->setParameter('code', $code)
			->getQuery()
			->getOneOrNullResult();
	}

	/**
	 * @return Symbol[]
	 */
	public function findAll () {
		return $this->createQueryBuilder('s')
			->getQuery()
			->getResult();
	}

	/**
	 * @return string
	 */
	public function LastUpdate () {
		/**
		 * @var Symbol $symbol
		 */
		$symbol = $this->findOneBy(array(), array('date_updated' => 'ASC'));

		return $symbol == null ? null : $symbol->getDateUpdated();
	}
}