<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211211142232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creating expenses table';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            'mysql' !== $this->connection->getDatabasePlatform()->getName(),
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql(<<<SQL
CREATE TABLE `expenses`
(
    `id`              INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `value`           DECIMAL(15,2)    NOT NULL,
    `description`     TEXT             NULL,
    `type_id`         INT(11) UNSIGNED NOT NULL,
    `created_at`      INT(11) UNSIGNED NOT NULL,
    `updated_at`      INT(11) UNSIGNED NOT NULL,
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
DROP TABLE expenses;
SQL
        );
    }
}
