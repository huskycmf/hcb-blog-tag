<?php
namespace HcbBlogTag\Service\Post;

use Doctrine\ORM\EntityManagerInterface;
use HcbBlog\Entity\Post\IdentifierInterface;
use HcbBlogTag\Data\TagInterface;

class BinderService
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
     * @param TagInterface $tagData
     * @param IdentifierInterface $postEntity
     */
    public function bind(TagInterface $tagData,
                         IdentifierInterface $postEntity)
    {
        try {
            $this->entityManager->beginTransaction();

            $tagData = $tagData->getTags();

            $qb = $this->entityManager
                       ->getRepository( 'HcbBlogTag\Entity\Tag' )
                       ->createQueryBuilder( 't' );

            $allPostTags = $qb->select()
                              ->join( 't.post', 'p' )
                              ->where( 'p = :post' )
                              ->setParameter( 'post', $postEntity )
                              ->getQuery()->getResult();


            /* @var $tagEntity \HcbBlogTag\Entity\Tag */
            foreach ( $allPostTags as $tagEntity ) {
                $tagEntity->removePost( $postEntity );
            }

            foreach ($tagData as $tagId) {
                /* @var $tagEntity \HcbBlogTag\Entity\Tag */
                $tagEntity = $this->entityManager
                                        ->getRepository('HcbBlogTag\Entity\Tag')
                                        ->find($tagId);

                $tagEntity->addPost($this->entityManager
                                         ->getReference('HcbBlog\Entity\Post',
                                                        $postEntity->getId()));
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }
}
