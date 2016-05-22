<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site\MainBundle\Entity\Amplua
 *
 * @ORM\Table(name="amplua")
 * @ORM\Entity
 */
class Amplua
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Амплуа
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * Амплуа сокращенно
     * @var string
     *
     * @ORM\Column(name="name_short", type="string", length=50, nullable=false)
     */
    private $nameShort;

    /**
     * Игроки
     * @ORM\OneToMany(targetEntity="Player", mappedBy="amplua")
     **/
    private $players;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Amplua
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
     * Set nameShort
     *
     * @param string $nameShort
     * @return Amplua
     */
    public function setNameShort($nameShort)
    {
        $this->nameShort = $nameShort;

        return $this;
    }

    /**
     * Get nameShort
     *
     * @return string 
     */
    public function getNameShort()
    {
        return $this->nameShort;
    }

    /**
     * Add players
     *
     * @param \Site\MainBundle\Entity\Player $players
     * @return Amplua
     */
    public function addPlayer(\Site\MainBundle\Entity\Player $players)
    {
        $this->players[] = $players;

        return $this;
    }

    /**
     * Remove players
     *
     * @param \Site\MainBundle\Entity\Player $players
     */
    public function removePlayer(\Site\MainBundle\Entity\Player $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }

    public function __toString(){
        return $this->name;
    }
}
