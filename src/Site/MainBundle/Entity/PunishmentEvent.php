<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Наказания в игре
 * Site\MainBundle\Entity\PunishmentEvent
 *
 * @ORM\Table(name="punishment_event")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\PunishmentEventRepository")
 */
class PunishmentEvent
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="punishmentEvent")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     **/
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = false;

    /**
     * @var string
     *
     * @ORM\Column(name="type_punishment", type="smallint", nullable=false)
     */
    private $typePunishment = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length = 50, nullable=true)
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="punishmentEvent")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     **/
    private $player;


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
     * Set type
     *
     * @param boolean $type
     * @return PunishmentEvent
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
     * Set typePunishment
     *
     * @param integer $typePunishment
     * @return PunishmentEvent
     */
    public function setTypePunishment($typePunishment)
    {
        $this->typePunishment = $typePunishment;

        return $this;
    }

    /**
     * Get typePunishment
     *
     * @return integer 
     */
    public function getTypePunishment()
    {
        return $this->typePunishment;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return PunishmentEvent
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set event
     *
     * @param \Site\MainBundle\Entity\Event $event
     * @return PunishmentEvent
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

    /**
     * Set player
     *
     * @param \Site\MainBundle\Entity\Player $player
     * @return PunishmentEvent
     */
    public function setPlayer(\Site\MainBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Site\MainBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }
}
