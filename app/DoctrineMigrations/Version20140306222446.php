<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140306222446 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE prayers ADD anonymous TINYINT(1) DEFAULT '0' NOT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE prayers DROP anonymous");
    }
}
