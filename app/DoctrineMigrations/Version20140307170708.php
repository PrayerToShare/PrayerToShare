<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140307170708 extends AbstractMigration
{
    const INVITES =<<<SQL
CREATE TABLE invites (
    code VARCHAR(32) NOT NULL
  , user_id INT NOT NULL
  , joined_user_id INT DEFAULT NULL
  , email VARCHAR(255) NOT NULL
  , createdAt DATETIME NOT NULL
  , PRIMARY KEY(code)
  , UNIQUE INDEX UNIQ_37E6A6C91CE3AA4 (joined_user_id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    public function up(Schema $schema)
    {
        $this->addSql(self::INVITES);
        $this->addSql("ALTER TABLE invites ADD CONSTRAINT FK_INVITES_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE invites ADD CONSTRAINT FK_INVITES_REF_USERS_JOINED_USER_ID FOREIGN KEY (joined_user_id) REFERENCES users (id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE invites");
    }
}
