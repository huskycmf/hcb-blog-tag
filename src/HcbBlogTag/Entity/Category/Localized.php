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
class Localized implements EntityInterface/*, PageBindInterface, LocaleBindInterface*/
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_timestamp", type="datetime", nullable=false)
     */
    private $updatedTimestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;
}
