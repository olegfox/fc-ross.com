<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Голы в игре
 * Site\MainBundle\Entity\GoalEvent
 *
 * @ORM\Table(name="goal_event")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\GoalEventRepository")
 */
class GoalEvent
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="goalEvent")
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
     * @ORM\Column(name="score", type="string", length = 50, nullable=true)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length = 50, nullable=true)
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="goalEvent")
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
     * @return GoalEvent
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
     * Set score
     *
     * @param string $score
     * @return GoalEvent
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return GoalEvent
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
     * @return GoalEvent
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
     * @return GoalEvent
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
