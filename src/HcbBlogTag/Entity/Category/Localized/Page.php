<?php
namespace HcbBlogTag\Entity\Tag\Localized;

use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\MappedPage;
use HcbBlogTag\Entity\Tag\Localized;
use HcCore\Entity\EntityInterface;

/**
 * Page
 *
 * @ORM\Table(name="post_tag_localized_page")
 * @ORM\Entity
 */
class Page extends MappedPage implements EntityInterface
{
    /**
     * @var Localized
     *
     * @ORM\OneToOne(targetEntity="HcbBlogTag\Entity\Tag\Localized", inversedBy="page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_tag_localized_id", referencedColumnName="id")
     * })
     */
    private $localized;

    /**
     * Set localized
     *
     * @param \HcbBlogTag\Entity\Tag\Localized $localized
     * @return Page
     */
    public function setLocalized(\HcbBlogTag\Entity\Tag\Localized $localized = null)
    {
        $this->localized = $localized;

        return $this;
    }

    /**
     * Get localized
     *
     * @return \HcbBlogTag\Entity\Tag\Localized
     */
    public function getLocalized()
    {
        return $this->localized;
    }
}
