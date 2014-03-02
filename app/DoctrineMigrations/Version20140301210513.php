<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20140301210513 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE users ADD firstName VARCHAR(32) DEFAULT NULL, ADD lastName VARCHAR(32) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE users DROP firstName, DROP lastName");
    }
}
