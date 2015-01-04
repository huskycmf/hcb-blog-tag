<?php
namespace HcbBlogTag\Stdlib\Extractor;

use Doctrine\ORM\EntityManager;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbBlogTag\Entity\Tag as TagEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  TagEntity $tagEntity
     *
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($tagEntity)
    {
        if (!$tagEntity instanceof TagEntity) {
            throw new InvalidArgumentException
                ("Expected HcbBlogTag\\Entity\\Tag object, invalid object given");
        }

        $localized = $tagEntity->getLocalized();
        $title = '__EMPTY__';
        if ($localized->count() > 0) {
            $localizedEntity = $localized->current();
            $title = $localizedEntity->getTitle();
        }

        return array('id'=> $tagEntity->getId(),
                     'name'=>$title);
    }
}
