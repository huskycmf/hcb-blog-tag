<?php
namespace HcbBlogTag\Entity\Tag;

use HcBackend\Entity\AliasBindInterface;
use HcBackend\Entity\AliasWiredInterface;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Alias
 *
 * @ORM\Table(name="post_tag_has_alias")
 * @ORM\Entity
 */
class Alias implements EntityInterface, AliasWiredInterface, AliasBindInterface
{
    /**
     * @var \HcBackend\Entity\Alias
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="\HcBackend\Entity\Alias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alias_id", referencedColumnName="id")
     * })
     */
    private $alias;

    /**
     * @var \HcbBlogTag\Entity\Tag
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\HcbBlogTag\Entity\Tag", inversedBy="alias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_tag_id", referencedColumnName="id")
     * })
     */
    private $tag;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_primary", type="boolean", nullable=true)
     */
    private $isPrimary;

    /**
     * Set isPrimary
     *
     * @param boolean $isPrimary
     * @return Alias
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * Get isPrimary
     *
     * @return boolean 
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * Set alias
     *
     * @param \HcBackend\Entity\Alias $alias
     * @return Alias
     */
    public function setAlias(\HcBackend\Entity\Alias $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return \HcBackend\Entity\Alias 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set tag
     *
     * @param \HcbBlogTag\Entity\Tag $tag
     * @return Alias
     */
    public function setTag(\HcbBlogTag\Entity\Tag $tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \HcbBlogTag\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
