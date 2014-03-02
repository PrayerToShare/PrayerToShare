<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140301220211 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE prayers CHANGE text text LONGTEXT NOT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE prayers CHANGE text text VARCHAR(255) NOT NULL");
    }
}
