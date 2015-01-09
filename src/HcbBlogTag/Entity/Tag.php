<?php
namespace HcbBlogTag\Entity;

use HcBackend\Entity\AliasBindAwareInterface;
use HcBackend\Entity\AliasBindInterface;
use HcBackend\Entity\AliasWiredAwareInterface;
use HcBackend\Entity\LocalizedInterface;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="post_tag")
 * @ORM\Entity
 */
class Tag implements EntityInterface, LocalizedInterface,
                     AliasWiredAwareInterface, AliasBindAwareInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority = 1;

    /**
     * @var Localized
     *
     * @ORM\OneToMany(targetEntity="HcbBlogTag\Entity\Tag\Localized", mappedBy="tag")
     */
    private $localized = null;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbBlog\Entity\Post", cascade={"persist"})
     * @ORM\JoinTable(name="post_tag_has_post",
     *   joinColumns={
     *     @ORM\JoinColumn(name="post_tag_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *   }
     * )
     */
    private $post;

    /**
     * @var \HcbBlogTag\Entity\Tag\Alias
     *
     * @ORM\OneToMany(targetEntity="HcbBlogTag\Entity\Tag\Alias", mappedBy="tag")
     */
    private $alias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->localized = new \Doctrine\Common\Collections\ArrayCollection();
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Tag
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Tag
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Tag
     */
    public function setCreatedTimestamp($createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;

        return $this;
    }

    /**
     * Get createdTimestamp
     *
     * @return \DateTime 
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
    }

    /**
     * Add localized
     *
     * @param \HcbBlogTag\Entity\Tag\Localized $localized
     * @return Tag
     */
    public function addLocalized(\HcbBlogTag\Entity\Tag\Localized $localized)
    {
        $this->localized[] = $localized;

        return $this;
    }

    /**
     * Remove localized
     *
     * @param \HcbBlogTag\Entity\Tag\Localized $localized
     */
    public function removeLocalized(\HcbBlogTag\Entity\Tag\Localized $localized)
    {
        $this->localized->removeElement($localized);
    }

    /**
     * Get localized
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalized()
    {
        return $this->localized;
    }

    /**
     * Add post
     *
     * @param \HcbBlog\Entity\Post $post
     * @return Tag
     */
    public function addPost(\HcbBlog\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \HcbBlog\Entity\Post $post
     */
    public function removePost(\HcbBlog\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Add alias
     *
     * @param AliasBindInterface $alias
     * @return Tag
     */
    public function addAlias(AliasBindInterface $aliasEntity)
    {
        $this->alias[] = $aliasEntity;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \HcbBlogTag\Entity\Tag\Alias $alias
     */
    public function removeAlias(\HcbBlogTag\Entity\Tag\Alias $alias)
    {
        $this->alias->removeElement($alias);
    }

    /**
     * Get alias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
