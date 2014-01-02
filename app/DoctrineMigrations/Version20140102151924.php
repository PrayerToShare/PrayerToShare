<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140102151924 extends AbstractMigration
{
    const USERS_SQL = <<<SQL
CREATE TABLE users (
    id INT AUTO_INCREMENT NOT NULL
  , username VARCHAR(255) NOT NULL
  , username_canonical VARCHAR(255) NOT NULL
  , email VARCHAR(255) NOT NULL
  , email_canonical VARCHAR(255) NOT NULL
  , enabled TINYINT(1) NOT NULL
  , salt VARCHAR(255) NOT NULL
  , password VARCHAR(255) NOT NULL
  , last_login DATETIME DEFAULT NULL
  , locked TINYINT(1) NOT NULL
  , expired TINYINT(1) NOT NULL
  , expires_at DATETIME DEFAULT NULL
  , confirmation_token VARCHAR(255) DEFAULT NULL
  , password_requested_at DATETIME DEFAULT NULL
  , roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)'
  , credentials_expired TINYINT(1) NOT NULL
  , credentials_expire_at DATETIME DEFAULT NULL
  , UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical)
  , UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical)
  , PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
SQL;

    public function up(Schema $schema)
    {
        $this->addSql(self::USERS_SQL);
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE users");
    }
}
