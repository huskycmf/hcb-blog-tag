<?php
namespace HcbBlogTag\Service\Post\Data\Collection;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use HcbBlogTag\Entity\Tag\Localized as LocalizedTagEntity;

class GetQbByTagService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param LocalizedTagEntity $localizedTagEntity
     * @return QueryBuilder
     */
    public function fetch(LocalizedTagEntity $localizedTagEntity)
    {
        /* @var $tqb QueryBuilder */
        $tqb = $this->entityManager
                    ->getRepository('HcbBlogTag\Entity\Tag')
                    ->createQueryBuilder('et');

        $tqb->select('etp.id')->join('et.post', 'etp')
            ->where('et = :tag')->andWhere('etp.enabled = 1')
            ->setParameter('tag', $localizedTagEntity);

        /* @var $qb QueryBuilder */
        $qb = $this->entityManager
                   ->getRepository('HcbBlog\Entity\Post\Data')
                   ->createQueryBuilder('d');

        $qb->select()
           ->where('d.post IN ('.$tqb->getDQL().')')
           ->andWhere('d.lang = :lang')
           ->setParameter('tag', $localizedTagEntity->getTag())
           ->setParameter('lang', $localizedTagEntity->getLocale()->getLocale());

       return $qb;
    }
}
