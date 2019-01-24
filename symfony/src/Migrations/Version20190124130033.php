<?php
declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20190124130033
 *
 * @package DoctrineMigrations
 */
final class Version20190124130033 extends AbstractMigration {
	/**
	 * @return string
	 */
	public function getDescription () : string {
		return '';
	}

	/**
	 * @param Schema $schema
	 */
	public function up (Schema $schema) : void {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

		$this->addSql('CREATE TEMPORARY TABLE __temp__Symbol AS SELECT id, code, rate, date_updated FROM Symbol');
		$this->addSql('DROP TABLE Symbol');
		$this->addSql('CREATE TABLE Symbol (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, date_updated VARCHAR(255) NOT NULL)');
		$this->addSql('INSERT INTO Symbol (id, code, rate, date_updated) SELECT id, code, rate, date_updated FROM __temp__Symbol');
		$this->addSql('DROP TABLE __temp__Symbol');
	}

	/**
	 * @param Schema $schema
	 */
	public function down (Schema $schema) : void {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

		$this->addSql('CREATE TEMPORARY TABLE __temp__Symbol AS SELECT id, code, rate, date_updated FROM Symbol');
		$this->addSql('DROP TABLE Symbol');
		$this->addSql('CREATE TABLE Symbol (id INTEGER NOT NULL, code CLOB DEFAULT NULL COLLATE BINARY, rate DOUBLE PRECISION DEFAULT NULL, date_updated DATETIME DEFAULT NULL, PRIMARY KEY(id))');
		$this->addSql('INSERT INTO Symbol (id, code, rate, date_updated) SELECT id, code, rate, date_updated FROM __temp__Symbol');
		$this->addSql('DROP TABLE __temp__Symbol');
	}
}
