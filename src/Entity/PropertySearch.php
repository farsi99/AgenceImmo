<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null 
     * @Assert\Range(min=10,max=400)
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $searchoptions;

    public function __construct()
    {
        $this->searchoptions = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice() : ? int
    {
        return $this->maxPrice;
    }

    /**
     *
     * @param integer|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice) : PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     *
     * @return int|null
     */
    public function getMinSurface() : ? int
    {
        return $this->minSurface;
    }

    /**
     *
     * @param integer|null $minSurface
     * @return void
     */
    public function setMinSurface(int $minSurface) : PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSearchoptions() : ArrayCollection
    {
        return $this->searchoptions;
    }
    /**
     * @param ArrayCollection $searchoptions
     */
    public function setSearchoptions(ArrayCollection $searchoptions) : void
    {
        $this->searchoptions = $searchoptions;
    }


}