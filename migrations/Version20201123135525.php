<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123135525 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE affilies (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, active TINYINT(1) NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affilies_categories (affilies_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_E84D655A144C5CF3 (affilies_id), INDEX IDX_E84D655AA21214B7 (categories_id), PRIMARY KEY(affilies_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jobs (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, contrat VARCHAR(100) NOT NULL, entreprise VARCHAR(100) NOT NULL, logo VARCHAR(100) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, token VARCHAR(255) DEFAULT NULL, email VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, expire DATETIME NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, postuler LONGTEXT NOT NULL, INDEX IDX_A8936DC512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affilies_categories ADD CONSTRAINT FK_E84D655A144C5CF3 FOREIGN KEY (affilies_id) REFERENCES affilies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affilies_categories ADD CONSTRAINT FK_E84D655AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT FK_A8936DC512469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affilies_categories DROP FOREIGN KEY FK_E84D655A144C5CF3');
        $this->addSql('ALTER TABLE affilies_categories DROP FOREIGN KEY FK_E84D655AA21214B7');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY FK_A8936DC512469DE2');
        $this->addSql('DROP TABLE affilies');
        $this->addSql('DROP TABLE affilies_categories');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE jobs');
    }
}
