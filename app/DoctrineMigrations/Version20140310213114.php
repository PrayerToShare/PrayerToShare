<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140310213114 extends AbstractMigration
{
    const EMAILS =<<<SQL
CREATE TABLE emails (
    id INT AUTO_INCREMENT NOT NULL
  , email VARCHAR(255) NOT NULL
  , template VARCHAR(255) NOT NULL
  , data LONGTEXT NOT NULL
  , status VARCHAR(10) NOT NULL
  , createdAt DATETIME NOT NULL
  , PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    public function up(Schema $schema)
    {
        $this->addSql(self::EMAILS);
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE emails");
    }
}
