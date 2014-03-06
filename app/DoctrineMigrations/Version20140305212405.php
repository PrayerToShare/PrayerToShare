<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140305212405 extends AbstractMigration
{
    const USER_ARCHIVED_PRAYERS =<<<SQL
CREATE TABLE user_archived_prayers (
    user_id INT NOT NULL
  , prayer_id INT NOT NULL
  , createdAt DATETIME NOT NULL
  , INDEX IDX_USER_ARCHIVED_PRAYERS_USER_ID (user_id)
  , INDEX IDX_USER_ARCHIVED_PRAYERS_PRAYER_ID (prayer_id)
  , PRIMARY KEY(user_id, prayer_id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    public function up(Schema $schema)
    {
        $this->addSql(self::USER_ARCHIVED_PRAYERS);
        $this->addSql("ALTER TABLE user_archived_prayers ADD CONSTRAINT FK_USER_ARCHIVED_PRAYERS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE user_archived_prayers ADD CONSTRAINT FK_USER_ARCHIVED_PRAYERS_REF_PRAYERS_PRAYER_ID FOREIGN KEY (prayer_id) REFERENCES prayers (id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE user_archived_prayers");
    }
}
