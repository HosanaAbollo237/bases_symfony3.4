<?php

namespace CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="CarBundle\Repository\CarRepository")
 */
class Car
{
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=255)
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @var int
     * 
     * @ORM\Column(name="price", type="integer")
     */
     private $price;


    /**
     * @var boolean
     * 
     * @ORM\Column(name="navigation", type="boolean")
     */
     private $navigation;

    /**
     * @var int
     * 
     * @ORM\Column(name="year", type="integer")
     */
      private $year;

     /**
      * Get price
      * 
      * @return int
      */
      public function getPrice(){
          return $this->price;
      }

      /**
       * Set price
       * 
       * @param int $price
       */
       public function setPrice($price){
           $this->price = $price;
           return $this;
       }

       /**
        * @return int 
        *
        */
        public function getNavigation(){
            return $this->navigation;
        }

        /**
         * Set Navigation
         * 
         * @param int $navigation
         * 
         */
        public function setNavigation($navigation){
            $this->navigation = $navigation;
            return $this;
        }

       /**
        * Get year
        * 
        * @return int
        */
        public function getYear(){
            return $this->year;
        }

        /**
         *  Set Year
         * 
         *@param int $year
         */
         public function setYear($year){
             $this->year = $year;
             return $this;
         }


    /**
     * Set description
     *
     * @param string $description
     *
     */
        public function setDescription($description){
            $this->description = $description;
            return $this;
        }
    
    /**
     * Get description
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


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
     * Set name
     *
     * @param string $name
     *
     * @return Car
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set make
     *
     * @param string $make
     *
     * @return Car
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }
}

