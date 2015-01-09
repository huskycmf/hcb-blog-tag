<?php
namespace HcbBlogTag\Stdlib\Extractor\Localized;

use Doctrine\ORM\EntityManagerInterface;
use HcBackend\Service\Alias\DetectAlias;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbBlogTag\Entity\Tag\Localized as LocalizedEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var DetectAlias
     */
    protected $detectAlias;

    /**
     * @param EntityManagerInterface $entityManager
     * @param DetectAlias $detectAlias
     */
    public function __construct(EntityManagerInterface $entityManager,
                                DetectAlias $detectAlias)
    {
        $this->entityManager = $entityManager;
        $this->detectAlias = $detectAlias;
    }

    /**
     * Extract values from an object
     *
     * @param  LocalizedEntity $localizedEntity
     *
     * @throws InvalidArgumentException
     * @return array
     */
    public function extract( $localizedEntity)
    {
        if ( !$localizedEntity instanceof LocalizedEntity) {
            throw new InvalidArgumentException
                ("Expected HcbBlogTag\\Entity\\Deal\\Localized object, invalid object given");
        }

        $localeEntity = $localizedEntity->getLocale();

        $aliasWireEntity = $this->detectAlias
                                ->detect($localizedEntity->getTag());

        $localData = array('locale'=>($localeEntity ? $localeEntity->getLocale() : ''),
                           'alias'=>(is_null($aliasWireEntity) ? '' :
                                    $aliasWireEntity->getAlias()->getName()),
                           'title'=>$localizedEntity->getTitle());

        if ( $localizedEntity->getId()) {
            $localData['id'] = $localizedEntity->getId();
        }

        return $localData;
    }
}
