<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Symbol
 *
 * @ORM\Entity(repositoryClass="App\Repository\SymbolRepository")
 *
 * @package App\Entity
 */
class Symbol {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	private $code;

	/**
	 * @ORM\Column(type="float")
	 */
	private $rate;

	/**
	 * @ORM\Column(type="string")
	 */
	private $date_updated;

	/**
	 * @return int
	 */
	public function getId () : int {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getCode () : string {
		return $this->code;
	}

	/**
	 * @param string $code
	 *
	 * @return Symbol
	 */
	public function setCode (string $code) : self {
		$this->code = $code;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getRate () {
		return $this->rate;
	}

	/**
	 * @param float $rate
	 */
	public function setRate (float $rate) {
		$this->rate = $rate;
	}

	/**
	 * @return string
	 */
	public function getDateUpdated () {
		return $this->date_updated;
	}

	/**
	 * @param string $date_updated
	 */
	public function setDateUpdated (string $date_updated) {
		$this->date_updated = $date_updated;
	}
}