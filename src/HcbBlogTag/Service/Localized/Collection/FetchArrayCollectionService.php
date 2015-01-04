<?php
namespace HcbBlogTag\Service\Localized\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use HcbBlogTag\Entity\Tag as TagEntity;
use HcCore\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use HcCore\Service\Filtration\Query\FiltrationServiceInterface;
use HcbStoreProduct\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchArrayCollectionService implements ResourceDataServiceInterface
{
    /**
     * @var FiltrationServiceInterface
     */
    protected $filtrationService;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param FiltrationServiceInterface $filtrationService
     */
    public function __construct(EntityManagerInterface $entityManager,
                                FiltrationServiceInterface $filtrationService)
    {
        $this->entityManager = $entityManager;
        $this->filtrationService = $filtrationService;
    }

    /**
     * @param TagEntity $tagEntity
     * @param Parameters $params
     *
     * @return ArrayCollection
     * @throws InvalidResourceException
     */
    public function fetch($tagEntity, Parameters $params = null)
    {
        if (!$tagEntity instanceof TagEntity) {
            throw new InvalidResourceException('tagEntity must be compatible with type HcbBlogTag\Entity\Tag');
        }

        /* @var $localizedRepository \Doctrine\ORM\EntityRepository */
        $localizedRepository = $this->entityManager
                                    ->getRepository('HcbBlogTag\Entity\Tag\Localized');

        $qb = $localizedRepository->createQueryBuilder('l');

        $qb->join('l.locale', 'locale')
           ->where('l.faq = :faq');

        $qb->setParameter('faq', $tagEntity);

        if (is_null($params)) {
            $result = $qb->getQuery()->getResult();
        } else {
            $result = $this->filtrationService
                           ->apply($params, $qb, 'l', array('lang'=>'locale.locale'))
                           ->getQuery()->getResult();
        }

        if (!count($result)) {
            $result[0] = new TagEntity\Localized();
            $result[0]->setFaq($tagEntity);
        }

        return new ArrayCollection($result);
    }
}
