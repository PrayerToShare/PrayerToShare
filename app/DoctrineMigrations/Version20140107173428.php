<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140107173428 extends AbstractMigration
{
    const PRAYER_REQUESTS_SQL =<<<SQL
CREATE TABLE prayers (
    id INT AUTO_INCREMENT NOT NULL
  , user_id INT DEFAULT NULL
  , text VARCHAR(255) NOT NULL
  , INDEX IDX_PRAYERS_USER_ID (user_id)
  , PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    public function up(Schema $schema)
    {
        $this->addSql(self::PRAYER_REQUESTS_SQL);
        $this->addSql("ALTER TABLE prayers ADD CONSTRAINT FK_PRAYERS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE prayer_requests");
    }
}
