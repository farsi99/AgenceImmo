<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228074320 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property_searchoption (property_id INT NOT NULL, searchoption_id INT NOT NULL, INDEX IDX_2B8EDF9C549213EC (property_id), INDEX IDX_2B8EDF9C9953F3BA (searchoption_id), PRIMARY KEY(property_id, searchoption_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE searchoption (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property_searchoption ADD CONSTRAINT FK_2B8EDF9C549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_searchoption ADD CONSTRAINT FK_2B8EDF9C9953F3BA FOREIGN KEY (searchoption_id) REFERENCES searchoption (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property_searchoption DROP FOREIGN KEY FK_2B8EDF9C9953F3BA');
        $this->addSql('DROP TABLE property_searchoption');
        $this->addSql('DROP TABLE searchoption');
    }
}
