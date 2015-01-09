<?php
namespace HcbBlogTag\Service\Localized;

use Doctrine\ORM\EntityManagerInterface;
use HcBackend\Service\Alias\AliasBinderServiceInterface;
use HcbBlogTag\Data\LocalizedInterface;
use HcbBlogTag\Entity\Tag\Localized as LocalizedEntity;
use HcbBlogTag\Entity\Tag\Alias as TagAliasEntity;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class UpdateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Response
     */
    protected $saveResponse;

    /**
     * @var AliasBinderServiceInterface
     */
    protected $aliasBinderService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Response $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                AliasBinderServiceInterface $aliasBinderService,
                                Response $saveResponse)
    {
        $this->entityManager = $entityManager;
        $this->saveResponse = $saveResponse;
        $this->aliasBinderService = $aliasBinderService;
    }

    /**
     * @param LocalizedEntity $localizedEntity
     * @param LocalizedInterface $localizedData
     *
     * @return Response
     */
    public function update(LocalizedEntity $localizedEntity,
                           LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $localizedEntity->setTitle($localizedData->getTitle());
            $tagEntity = $localizedEntity->getTag();

            $tagAliasEntity = new TagAliasEntity();
            $this->aliasBinderService->bind($localizedData,
                                            $tagEntity,
                                            $tagAliasEntity);

            $tagAliasEntity->setTag($tagEntity);
            $tagAliasEntity->setIsPrimary(true);

            $tagEntity->setEnabled(true);

            $this->entityManager->persist($tagAliasEntity);
            $this->entityManager->persist($localizedEntity);

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->saveResponse->error($e->getMessage())->failed();
            return $this->saveResponse;
        }

        $this->saveResponse->success();
        return $this->saveResponse;
    }
}
