<?php
namespace HcbBlogTag\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use HcBackend\Service\Alias\FetchLocalizedServiceInterface;

class FetchByAliasService implements FetchLocalizedServiceInterface
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
     * @param string $alias
     * @return \HcBackend\Entity\LocalizedInterface | null
     */
    public function fetch($alias)
    {
        /* @var $qb QueryBuilder */
        $qb = $this->entityManager
                   ->getRepository('HcbBlogTag\Entity\Tag\Alias')
                   ->createQueryBuilder('a');

        $qb->select(array('a'))
           ->join('a.alias', 'aa')
           ->join('a.tag', 'at')
           ->where('at.enabled = 1')
           ->andWhere('aa.name = :alias')
           ->setParameter('alias', $alias);

        /* @var $aliasEntity \HcbBlogTag\Entity\Tag\Alias */
        $aliasEntity = $qb->getQuery()->getOneOrNullResult();

        if (is_null($aliasEntity)) {
            return null;
        }

        return $aliasEntity->getTag();
    }
}
