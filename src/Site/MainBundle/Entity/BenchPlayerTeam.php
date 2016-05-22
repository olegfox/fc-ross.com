<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Запасные
 * Site\MainBundle\Entity\BenchPlayerTeam
 *
 * @ORM\Table(name="bench_player_team")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\BenchPlayerTeamRepository")
 */
class BenchPlayerTeam
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="benchPlayerTeam")
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
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="benchPlayerTeam")
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
     * @return BenchPlayerTeam
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
     * @return BenchPlayerTeam
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
     * @return BenchPlayerTeam
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
