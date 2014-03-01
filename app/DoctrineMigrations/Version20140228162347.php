<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140228162347 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE prayers ADD prayer_group_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE prayers ADD CONSTRAINT FK_PRAYERS_REF_PRAYER_GROUPS_PRAYER_GROUP_ID FOREIGN KEY (prayer_group_id) REFERENCES prayer_groups (id)");
        $this->addSql("CREATE INDEX IDX_PRAYERS_PRAYER_GROUP_ID ON prayers (prayer_group_id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE prayers DROP FOREIGN KEY FK_PRAYERS_REF_PRAYER_GROUPS_PRAYER_GROUP_ID");
        $this->addSql("DROP INDEX IDX_PRAYERS_PRAYER_GROUP_ID ON prayers");
        $this->addSql("ALTER TABLE prayers DROP prayer_group_id");
    }
}
