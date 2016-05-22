<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * BenchCoach
 *
 * @ORM\Table(name="bench_coach")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\BenchCoachRepository")
 */
class BenchCoach
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = false;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="benchCoach")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     **/
    private $event;


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
     * @return BenchCoach
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
     * Set type
     *
     * @param boolean $type
     * @return BenchCoach
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set event
     *
     * @param \Site\MainBundle\Entity\Event $event
     * @return BenchCoach
     */
    public function setEvent(\Site\MainBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Site\MainBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
