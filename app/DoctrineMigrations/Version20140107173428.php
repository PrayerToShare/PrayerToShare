<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140107173428 extends AbstractMigration
{
    const PRAYER_REQUESTS =<<<SQL
CREATE TABLE prayers (
    id INT AUTO_INCREMENT NOT NULL
  , user_id INT DEFAULT NULL
  , text VARCHAR(255) NOT NULL
  , createdAt DATETIME NOT NULL
  , INDEX IDX_PRAYERS_USER_ID (user_id)
  , PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    const PRAYER_GROUPS =<<<SQL
CREATE TABLE prayer_groups (
    id INT AUTO_INCREMENT NOT NULL
  , name VARCHAR(64) NOT NULL
  , public TINYINT(1) NOT NULL
  , PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    const PRAYER_GROUP_MEMBERS =<<<SQL
CREATE TABLE prayer_group_members (
    user_id INT NOT NULL
  , prayer_group_id INT NOT NULL
  , admin TINYINT(1) NOT NULL
  , INDEX IDX_PRAYER_GROUP_MEMBERS_USER_ID (user_id)
  , INDEX IDX_PRAYER_GROUP_MEMBERS_GROUP_ID (prayer_group_id)
  , PRIMARY KEY(user_id, prayer_group_id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
SQL;

    public function up(Schema $schema)
    {
        $this->addSql(self::PRAYER_REQUESTS);
        $this->addSql("ALTER TABLE prayers ADD CONSTRAINT FK_PRAYERS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql(self::PRAYER_GROUPS);
        $this->addSql(self::PRAYER_GROUP_MEMBERS);
        $this->addSql("ALTER TABLE prayer_group_members ADD CONSTRAINT FK_PRAYER_GROUP_MEMBERS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE prayer_group_members ADD CONSTRAINT FK_PRAYER_GROUP_MEMBERS_REF_PRAYER_GROUPS_PRAYER_GROUP_ID FOREIGN KEY (prayer_group_id) REFERENCES prayer_groups (id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE prayers");
        $this->addSql("DROP TABLE prayer_group_members");
        $this->addSql("DROP TABLE prayer_groups");
    }
}
