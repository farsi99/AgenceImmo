<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @Vich\Uploadable()
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
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(mimeTypes="image/jpeg")
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     */
    private $imageFile;

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


    public function getFilename() : ? string
    {
        return $this->filename;
    }

    public function setFilename(? string $filename) : Property
    {
        $this->filename = $filename;

        return $this;
    }

    public function getimageFile() : ? File
    {
        return $this->imageFile;
    }

    public function setImageFile(? File $imageFile) : Property
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \Datetime('now');
        }
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
}
