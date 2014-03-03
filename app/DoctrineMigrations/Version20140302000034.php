<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140302000034 extends AbstractMigration
{
    const USER_PRAYER_LIST =<<<SQL
CREATE TABLE user_prayer_list (
    user_id INT NOT NULL
  , prayer_id INT NOT NULL
  , INDEX IDX_USER_PRAYER_LIST_USER_ID (user_id)
  , INDEX IDX_USER_PRAYER_LIST_PRAYER_ID (prayer_id)
  , PRIMARY KEY(user_id, prayer_id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    public function up(Schema $schema)
    {
        $this->addSql(self::USER_PRAYER_LIST);
        $this->addSql("ALTER TABLE user_prayer_list ADD CONSTRAINT FK_USER_PRAYER_LIST_REF_USERS FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE user_prayer_list ADD CONSTRAINT FK_USER_PRAYER_LIST_REF_PRAYERS FOREIGN KEY (prayer_id) REFERENCES prayers (id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE user_prayer_list");
    }
}
