<?php
namespace HcbBlogTag\Service;

use Doctrine\ORM\EntityManagerInterface;
use HcbBlogTag\Entity\Tag as TagEntity;
use HcCore\Service\CommandInterface;
use HcbBlogTag\Stdlib\Service\Response\CreateResponse;

class CreateService implements CommandInterface
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
     * @param EntityManagerInterface $entityManager
     * @param CreateResponse $createResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                CreateResponse $createResponse)
    {
        $this->entityManager = $entityManager;
        $this->createResponse = $createResponse;
    }

    /**
     * @return CreateResponse
     */
    public function execute()
    {
        try {
            $this->entityManager->beginTransaction();

            $tagEntity = new TagEntity();
            $tagEntity->setCreatedTimestamp(new \DateTime());

            $this->entityManager->persist($tagEntity);

            $this->entityManager->flush();

            $this->createResponse->setResource($tagEntity->getId());
            
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
