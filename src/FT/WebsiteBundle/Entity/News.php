<?php

namespace FT\WebsiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="FT\WebsiteBundle\Repository\NewsRepository")
 */
class News
{

    public function __construct()
    {
        #Je précise le fuseau horaire afin d'éviter tout décalage sur la date et l'heure
        $this->date = new \DateTime("Europe/Paris");
        $this->images = new ArrayCollection();

    }

    /**
     * @ORM\OneToMany(targetEntity="FT\WebsiteBundle\Entity\Image", mappedBy="news", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $images;


    public function addImage(\FT\WebsiteBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        $image->setNews($this);

        return $this;
    }

    public function removeImage(\FT\WebsiteBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * News constructor.
     * @param \DateTime $date
     */



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return News
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
     * Set content
     *
     * @param string $content
     *
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return News
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
