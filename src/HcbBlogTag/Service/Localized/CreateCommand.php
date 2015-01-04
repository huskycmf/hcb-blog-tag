<?php
namespace HcbBlogTag\Service\Localized;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbBlogTag\Data\LocalizedInterface;
use HcbBlogTag\Entity\Tag as TagEntity;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class CreateCommand implements ResourceCommandInterface
{
    /**
     * @var LocalizedInterface
     */
    protected $localizedData;

    /**
     * @var CreateService
     */
    protected $service;

    /**
     * @param LocalizedInterface $localizedData
     * @param CreateService $service
     */
    public function __construct(LocalizedInterface $localizedData,
                                CreateService $service)
    {
        $this->localizedData = $localizedData;
        $this->service = $service;
    }

    /**
     * @param TagEntity $tagEntity
     *
     * @return Response
     */
    public function execute(EntityInterface $tagEntity)
    {
        return $this->service->save($tagEntity, $this->localizedData);
    }
}
