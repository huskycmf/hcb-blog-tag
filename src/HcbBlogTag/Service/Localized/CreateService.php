<?php
namespace HcbBlogTag\Service\Localized;

use HcbBlogTag\Service\LocaleBinderService;
use Doctrine\ORM\EntityManagerInterface;
use HcbBlogTag\Data\LocalizedInterface;
use HcbBlogTag\Entity\Tag as TagEntity;
use HcbBlogTag\Stdlib\Service\Response\CreateResponse;

class CreateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var CreateResponse
     */
    protected $createResponse;

    /**
     * @var LocaleBinderService
     */
    protected $localeBinderService;

    /**
     * @var UpdateService
     */
    protected $updateService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param LocaleBinderService $localeService
     * @param UpdateService $updateService
     * @param CreateResponse $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                LocaleBinderService $localeBinderService,
                                UpdateService $updateService,
                                CreateResponse $saveResponse)
    {
        $this->localeBinderService = $localeBinderService;
        $this->updateService = $updateService;
        $this->entityManager = $entityManager;
        $this->createResponse = $saveResponse;
    }

    /**
     * @param TagEntity $tagEntity
     * @param LocalizedInterface $localizedData
     *
     * @return CreateResponse
     */
    public function save(TagEntity $tagEntity, LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $localizedEntity = new TagEntity\Localized();
            $localizedEntity->setFaq($tagEntity);

            $response = $this->localeBinderService
                             ->bind($localizedData, $localizedEntity);

            if ($response->isFailed()) {
                return $response;
            }

            $response = $this->updateService->update($localizedEntity, $localizedData);

            if ($response->isFailed()) {
                return $response;
            }

            $this->entityManager->flush();

            $this->createResponse->setResource($localizedEntity->getId());
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->createResponse->error($e->getMessage())->failed();
            return $this->createResponse;
        }

        $this->createResponse->success();
        return $this->createResponse;
    }
}
