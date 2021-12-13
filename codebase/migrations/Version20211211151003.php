<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211211151003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creating expense_type table';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            'mysql' !== $this->connection->getDatabasePlatform()->getName(),
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(<<<SQL
CREATE TABLE `expense_types`
(
    `id`              INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`            VARCHAR(50)      NOT NULL,
    `created_at`      INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            'mysql' !== $this->connection->getDatabasePlatform()->getName(),
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(<<<SQL
DROP TABLE expense_types;
SQL
        );
    }
}

