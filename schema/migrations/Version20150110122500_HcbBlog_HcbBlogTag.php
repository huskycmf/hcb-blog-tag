<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20150110122500_HcbBlog_HcbBlogTag extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `post_tag_has_alias` DROP FOREIGN KEY  `fk_post_tag_has_alias_post_tag1` ,
ADD FOREIGN KEY (  `post_tag_id` ) REFERENCES  `post_tag` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `post_tag_has_alias` DROP FOREIGN KEY  `fk_post_tag_has_alias_alias1` ,
ADD FOREIGN KEY (  `alias_id` ) REFERENCES  `alias` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
");
        $this->addSql("ALTER TABLE  `post_tag_has_post` DROP FOREIGN KEY  `fk_post_tag_has_post_post_tag1` ,
ADD FOREIGN KEY (  `post_tag_id` ) REFERENCES  `post_tag` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `post_tag_has_post` DROP FOREIGN KEY  `fk_post_tag_has_post_post1` ,
ADD FOREIGN KEY (  `post_id` ) REFERENCES  `post` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");

        $this->addSql("ALTER TABLE  `post_tag_localized` DROP FOREIGN KEY  `fk_post_tag_localized_locale1` ,
ADD FOREIGN KEY (  `locale_id` ) REFERENCES  `locale` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `post_tag_localized` DROP FOREIGN KEY  `fk_post_tag_localized_post_tag1` ,
ADD FOREIGN KEY (  `post_tag_id` ) REFERENCES  `post_tag` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");

        $this->addSql("ALTER TABLE  `post_tag_localized_page` DROP FOREIGN KEY  `fk_post_tag_localized_page_post_tag_localized1` ,
ADD FOREIGN KEY (  `post_tag_localized_id` ) REFERENCES  `post_tag_localized` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");
    }

    public function down(Schema $schema)
    {
        $schema->dropTable("ALTER TABLE  `post_tag_has_alias` DROP FOREIGN KEY  `post_tag_has_alias_ibfk_1` ,
ADD FOREIGN KEY (  `post_tag_id` ) REFERENCES  `post_tag` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `post_tag_has_alias` DROP FOREIGN KEY  `post_tag_has_alias_ibfk_2` ,
ADD FOREIGN KEY (  `alias_id` ) REFERENCES  `alias` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
        $schema->dropTable("ALTER TABLE  `post_tag_has_post` DROP FOREIGN KEY  `post_tag_has_post_ibfk_1` ,
ADD FOREIGN KEY (  `post_tag_id` ) REFERENCES  `post_tag` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `post_tag_has_post` DROP FOREIGN KEY  `post_tag_has_post_ibfk_2` ,
ADD FOREIGN KEY (  `post_id` ) REFERENCES  `post` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
        $schema->dropTable("ALTER TABLE  `post_tag_localized` DROP FOREIGN KEY  `post_tag_localized_ibfk_1` ,
ADD FOREIGN KEY (  `locale_id` ) REFERENCES  `locale` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `post_tag_localized` DROP FOREIGN KEY  `post_tag_localized_ibfk_2` ,
ADD FOREIGN KEY (  `post_tag_id` ) REFERENCES  `post_tag` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
        $schema->dropTable("ALTER TABLE  `post_tag_localized_page` DROP FOREIGN KEY  `post_tag_localized_page_ibfk_1` ,
ADD FOREIGN KEY (  `post_tag_localized_id` ) REFERENCES  `post_tag_localized` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
    }
}
