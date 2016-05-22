<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site\MainBundle\Entity\EventTeam
 *
 * @ORM\Table(name="event_team")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\EventTeamRepository")
 */
class EventTeam
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="eventTeam")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     **/
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="eventTeam")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     **/
    private $team;

    /**
     * @var integer
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position = 0;

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
     * Set position
     *
     * @param integer $position
     * @return EventTeam
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set event
     *
     * @param \Site\MainBundle\Entity\Event $event
     * @return EventTeam
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
     * Set team
     *
     * @param \Site\MainBundle\Entity\Team $team
     * @return EventTeam
     */
    public function setTeam(\Site\MainBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Site\MainBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

}
