<?php
namespace HcbBlogTag\Entity\Tag;

use HcBackend\Entity\PageBindInterface;
use HcBackend\Entity\PageInterface;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use HcCore\Entity\LocaleBindInterface;

/**
 * Localized
 *
 * @ORM\Table(name="post_tag_localized")
 * @ORM\Entity
 */
class Localized implements EntityInterface, PageBindInterface, LocaleBindInterface
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
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="HcbBlogTag\Entity\Tag", inversedBy="localized")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_tag_id", referencedColumnName="id")
     * })
     */
    private $tag;

    /**
     * @var Page
     *
     * @ORM\OneToOne(targetEntity="HcbBlogTag\Entity\Tag\Localized\Page", mappedBy="localized")
     */
    private $page;

    /**
     * @var Locale
     *
     * @ORM\OneToOne(targetEntity="HcCore\Entity\Locale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     * })
     */
    private $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private $title;

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
     * Set title
     *
     * @param string $title
     * @return Localized
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set tag
     *
     * @param \HcbBlogTag\Entity\Tag $tag
     * @return Localized
     */
    public function setTag(\HcbBlogTag\Entity\Tag $tag = null)
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

    /**
     * Set page
     *
     * @param PageInterface $page
     * @return Localized
     */
    public function setPage(PageInterface $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return PageInterface
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set locale
     *
     * @param \HcCore\Entity\Locale $locale
     * @return Localized
     */
    public function setLocale(\HcCore\Entity\Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \HcCore\Entity\Locale 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
