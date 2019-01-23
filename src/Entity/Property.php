<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 */
class Property
{
    const HEAT = [
        0 => 'Electrique',
        1 => 'Gaz'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex("/^[0-9]{5}$/")
     */
    private $postal_code;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": false})
     */
    private $sold = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(min=10,max=400)
     */
    private $surface;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Searchoption", inversedBy="properties")
     */
    private $searchoptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="property", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

    /** 
     * @var Array
     */
    private $pictureFiles;

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getTitle() : ? string
    {
        return $this->title;
    }

    public function setTitle(string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug() : ? string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription() : ? string
    {
        return $this->description;
    }

    public function setDescription(? string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    public function getRooms() : ? int
    {
        return $this->rooms;
    }

    public function setRooms(? int $rooms) : self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms() : ? int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(? int $bedrooms) : self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor() : ? int
    {
        return $this->floor;
    }

    public function setFloor(? int $floor) : self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice() : ? int
    {
        return $this->price;
    }

    public function setPrice(? int $price) : self
    {
        $this->price = $price;

        return $this;
    }

    public function getFormatedPrice()
    {
        return number_format($this->price, 0, ' ', ' ');
    }

    public function getHeat() : ? int
    {
        return $this->heat;
    }

    public function getHeatType()
    {
        return self::HEAT[$this->heat];
    }

    public function setHeat(? int $heat) : self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getCity() : ? string
    {
        return $this->city;
    }

    public function setCity(? string $city) : self
    {
        $this->city = $city;

        return $this;
    }

    public function getAdresse() : ? string
    {
        return $this->adresse;
    }

    public function setAdresse(? string $adresse) : self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPostalCode() : ? string
    {
        return $this->postal_code;
    }

    public function setPostalCode(? string $postal_code) : self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getSold() : ? bool
    {
        return $this->sold;
    }

    public function setSold(? bool $sold) : self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt() : ? \DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(? \DateTimeInterface $created_at) : self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt() : ? \DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(? \DateTimeInterface $updated_at) : self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->searchoptions = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }


    public function getSurface() : ? int
    {
        return $this->surface;
    }

    public function setSurface(? int $surface) : self
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * @return Collection|Searchoption[]
     */
    public function getSearchoptions() : Collection
    {
        return $this->searchoptions;
    }

    public function addSearchoption(Searchoption $searchoption) : self
    {
        if (!$this->searchoptions->contains($searchoption)) {
            $this->searchoptions[] = $searchoption;
            $searchoption->addProperty($this);
        }

        return $this;
    }

    public function removeSearchoption(Searchoption $searchoption) : self
    {
        if ($this->searchoptions->contains($searchoption)) {
            $this->searchoptions->removeElement($searchoption);
            $searchoption->removeProperty($this);
        }

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures() : Collection
    {
        return $this->pictures;
    }

    public function getPicture() : ? Picture
    {
        if (empty($this->pictures)) {
            return null;
        }
        return $this->pictures[0];

    }
    public function addPicture(Picture $picture) : self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProperty($this);
        }

        return $this;
    }

    /** 
     * @return mixed
     */
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }

    /**
     * @param mixed mixed $pictureFiles
     * @return Property
     */
    public function setPictureFiles($pictureFiles) : self
    {
        foreach ($pictureFiles as $pictureFile) {
            $picture = new Picture();
            $picture->setImageFile($pictureFile);
            $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFile;
        return $this;
    }

    public function removePicture(Picture $picture) : self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }
}
