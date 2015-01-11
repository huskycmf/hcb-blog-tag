<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version00000000000000_HcbBlog_HcbBlogTag extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `priority` smallint(5) unsigned NOT NULL DEFAULT '1',
  `enabled` tinyint(3) unsigned NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `post_tag_has_alias`;
CREATE TABLE IF NOT EXISTS `post_tag_has_alias` (
  `post_tag_id` int(10) unsigned NOT NULL,
  `alias_id` int(10) unsigned NOT NULL,
  `is_primary` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`post_tag_id`,`alias_id`),
  KEY `fk_post_tag_has_alias_alias1_idx` (`alias_id`),
  KEY `fk_post_tag_has_alias_post_tag1_idx` (`post_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `post_tag_has_post`;
CREATE TABLE IF NOT EXISTS `post_tag_has_post` (
  `post_tag_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_tag_id`,`post_id`),
  KEY `fk_post_tag_has_post_post1_idx` (`post_id`),
  KEY `fk_post_tag_has_post_post_tag1_idx` (`post_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `post_tag_localized`;
CREATE TABLE IF NOT EXISTS `post_tag_localized` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale_id` int(10) unsigned NOT NULL,
  `post_tag_id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_tag_localized_post_tag1_idx` (`post_tag_id`),
  KEY `fk_post_tag_localized_locale1_idx` (`locale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `post_tag_localized_page`;
CREATE TABLE IF NOT EXISTS `post_tag_localized_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_tag_localized_id` int(10) unsigned zerofill NOT NULL,
  `content` text,
  `keywords` varchar(300) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  KEY `fk_post_tag_localized_page_post_tag_localized1_idx` (`post_tag_localized_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


ALTER TABLE `post_tag_has_alias`
  ADD CONSTRAINT `fk_post_tag_has_alias_alias1` FOREIGN KEY (`alias_id`) REFERENCES `alias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_tag_has_alias_post_tag1` FOREIGN KEY (`post_tag_id`) REFERENCES `post_tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `post_tag_has_post`
  ADD CONSTRAINT `fk_post_tag_has_post_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_tag_has_post_post_tag1` FOREIGN KEY (`post_tag_id`) REFERENCES `post_tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `post_tag_localized`
  ADD CONSTRAINT `fk_post_tag_localized_locale1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_tag_localized_post_tag1` FOREIGN KEY (`post_tag_id`) REFERENCES `post_tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `post_tag_localized_page`
  ADD CONSTRAINT `fk_post_tag_localized_page_post_tag_localized1` FOREIGN KEY (`post_tag_localized_id`) REFERENCES `post_tag_localized` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;");
    }

    public function down(Schema $schema)
    {
        $schema->dropTable("post_tag_localized_page");
        $schema->dropTable("post_tag_localized");
        $schema->dropTable("post_tag_has_post");
        $schema->dropTable("post_tag_has_alias");
        $schema->dropTable("post_tag");
    }
}
