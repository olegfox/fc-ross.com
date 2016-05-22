<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\EventRepository")
 */
class Event
{

    const NAME_CHAMPIONSHIP = 0;
    const NAME_CUP = 1;
    const NAME_EUROPA_LEAGUE = 2;
    const NAME_YOUTH_CHAMPIONSHIP = 3;

    const FINAL_1 = 0;
    const FINAL_1_2 = 1;
    const FINAL_1_4 = 2;
    const FINAL_1_8 = 3;
    const FINAL_1_16 = 4;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=100, nullable=true)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=500, nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=500, nullable=true)
     */
    private $metaKeywords;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Тур
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $tour;

    /**
     * Название турнира
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $name = 0;

    /**
     * Дата и время события
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * Счет
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=50, nullable=true)
     */
    private $score;

    /**
     * Количество голов
     * @var string
     *
     * @ORM\Column(name="number_goals", type="smallint", nullable=true)
     */
    private $numberGoals = 0;

    /**
     * Количество желтых карточек
     * @var string
     *
     * @ORM\Column(name="number_yellow_cards", type="smallint", nullable=true)
     */
    private $numberYellowCards = 0;

    /**
     * Стадион
     * @var string
     *
     * @ORM\Column(name="stadium", type="string", length=100, nullable=true)
     */
    private $stadium;

    /**
     * @ORM\OneToMany(targetEntity="EventTeam", mappedBy="event", cascade={"persist", "remove"})
     * @ORM\OrderBy({"position" = "ASC"})
     **/
    private $eventTeam;

    /**
     * @ORM\OneToMany(targetEntity="BenchCoach", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $benchCoach;

    /**
     * Состав команд
     * @ORM\OneToMany(targetEntity="PlayerTeam", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $playerTeam;

    /**
     * Запасные
     * @ORM\OneToMany(targetEntity="BenchPlayerTeam", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $benchPlayerTeam;

    /**
     * Накзания в игре
     * @ORM\OneToMany(targetEntity="PunishmentEvent", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $punishmentEvent;

    /**
     * Голы в игре
     * @ORM\OneToMany(targetEntity="GoalEvent", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $goalEvent;

    /**
     * Финал
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $final;

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
     * @param integer $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return integer 
     */
    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        switch($this->name){
            case 0: {
                return 'chiempionat';
            }break;
            case 1: {
                return 'kubok';
            }break;
            case 2: {
                return 'ligha-ievropy';
            }break;
            case 3: {
                return 'dubliruiushchii-sostav-1';
            }break;
            default: {
                return 'chiempionat';
            }break;
        }
    }

    public function getNameText()
    {
        switch($this->name){
            case 0: {
                return 'backend.event.name_choice.championship';
            }break;
            case 1: {
                return 'backend.event.name_choice.cup';
            }break;
            case 2: {
                return 'backend.event.name_choice.europa_league';
            }break;
            case 3: {
                return 'backend.event.name_choice.youth_championship';
            }break;
            default: {
                return 'backend.event.name_choice.championship';
            }break;
        }
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Event
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set score
     *
     * @param string $score
     * @return Event
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

    public function getScore1(){
        if(isset($this->getEventTeam()[0])){
            return explode(':', $this->getScore())[0];
        }

        return 0;
    }

    public function getScore2(){
        if(isset($this->getEventTeam()[1])){
            return explode(':', $this->getScore())[1];
        }

        return 0;
    }

    /**
     * Set numberGoals
     *
     * @param integer $numberGoals
     * @return Event
     */
    public function setNumberGoals($numberGoals)
    {
        $this->numberGoals = $numberGoals;

        return $this;
    }

    /**
     * Get numberGoals
     *
     * @return integer 
     */
    public function getNumberGoals()
    {
        return $this->numberGoals;
    }

    /**
     * Set numberYellowCards
     *
     * @param integer $numberYellowCards
     * @return Event
     */
    public function setNumberYellowCards($numberYellowCards)
    {
        $this->numberYellowCards = $numberYellowCards;

        return $this;
    }

    /**
     * Get numberYellowCards
     *
     * @return integer 
     */
    public function getNumberYellowCards()
    {
        return $this->numberYellowCards;
    }

    /**
     * Set stadium
     *
     * @param string $stadium
     * @return Event
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Get stadium
     *
     * @return string 
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Set tour
     *
     * @param integer $tour
     * @return Event
     */
    public function setTour($tour)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return integer 
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventTeam = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventTeam
     *
     * @param \Site\MainBundle\Entity\EventTeam $eventTeam
     * @return Event
     */
    public function addEventTeam(\Site\MainBundle\Entity\EventTeam $eventTeam)
    {
        $this->eventTeam[] = $eventTeam;

        return $this;
    }

    /**
     * Remove eventTeam
     *
     * @param \Site\MainBundle\Entity\EventTeam $eventTeam
     */
    public function removeEventTeam(\Site\MainBundle\Entity\EventTeam $eventTeam)
    {
        $this->eventTeam->removeElement($eventTeam);
    }

    /**
     * Get eventTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventTeam()
    {
        return $this->eventTeam;
    }

    public function getEventTeamString(){
        $string = "";
        for($i = 0; $i < count($this->getEventTeam()); $i++){
            $eventTeam = $this->getEventTeam()[$i];
            $string = $string . $eventTeam->getTeam()->getName();
            if($i != count($this->getEventTeam()) - 1){
                $string = $string . ' - ';
            }
        }
        return $string;
    }

    /**
     * Add benchCoach
     *
     * @param \Site\MainBundle\Entity\BenchCoach $benchCoach
     * @return Event
     */
    public function addBenchCoach(\Site\MainBundle\Entity\BenchCoach $benchCoach)
    {
        $this->benchCoach[] = $benchCoach;

        return $this;
    }

    /**
     * Remove benchCoach
     *
     * @param \Site\MainBundle\Entity\BenchCoach $benchCoach
     */
    public function removeBenchCoach(\Site\MainBundle\Entity\BenchCoach $benchCoach)
    {
        $this->benchCoach->removeElement($benchCoach);
    }

    /**
     * Get benchCoach
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBenchCoach()
    {
        return $this->benchCoach;
    }

    /**
     * Add playerTeam
     *
     * @param \Site\MainBundle\Entity\PlayerTeam $playerTeam
     * @return Event
     */
    public function addPlayerTeam(\Site\MainBundle\Entity\PlayerTeam $playerTeam)
    {
        $this->playerTeam[] = $playerTeam;

        return $this;
    }

    /**
     * Remove playerTeam
     *
     * @param \Site\MainBundle\Entity\PlayerTeam $playerTeam
     */
    public function removePlayerTeam(\Site\MainBundle\Entity\PlayerTeam $playerTeam)
    {
        $this->playerTeam->removeElement($playerTeam);
    }

    /**
     * Get playerTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayerTeam()
    {
        return $this->playerTeam;
    }

    /**
     * Add punishmentEvent
     *
     * @param \Site\MainBundle\Entity\PunishmentEvent $punishmentEvent
     * @return Event
     */
    public function addPunishmentEvent(\Site\MainBundle\Entity\PunishmentEvent $punishmentEvent)
    {
        $this->punishmentEvent[] = $punishmentEvent;

        return $this;
    }

    /**
     * Remove punishmentEvent
     *
     * @param \Site\MainBundle\Entity\PunishmentEvent $punishmentEvent
     */
    public function removePunishmentEvent(\Site\MainBundle\Entity\PunishmentEvent $punishmentEvent)
    {
        $this->punishmentEvent->removeElement($punishmentEvent);
    }

    /**
     * Get punishmentEvent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPunishmentEvent()
    {
        return $this->punishmentEvent;
    }

    /**
     * Add goalEvent
     *
     * @param \Site\MainBundle\Entity\GoalEvent $goalEvent
     * @return Event
     */
    public function addGoalEvent(\Site\MainBundle\Entity\GoalEvent $goalEvent)
    {
        $this->goalEvent[] = $goalEvent;

        return $this;
    }

    /**
     * Remove goalEvent
     *
     * @param \Site\MainBundle\Entity\GoalEvent $goalEvent
     */
    public function removeGoalEvent(\Site\MainBundle\Entity\GoalEvent $goalEvent)
    {
        $this->goalEvent->removeElement($goalEvent);
    }

    /**
     * Get goalEvent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGoalEvent()
    {
        return $this->goalEvent;
    }

    /**
     * Add benchPlayerTeam
     *
     * @param \Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam
     * @return Event
     */
    public function addBenchPlayerTeam(\Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam)
    {
        $this->benchPlayerTeam[] = $benchPlayerTeam;

        return $this;
    }

    /**
     * Remove benchPlayerTeam
     *
     * @param \Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam
     */
    public function removeBenchPlayerTeam(\Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam)
    {
        $this->benchPlayerTeam->removeElement($benchPlayerTeam);
    }

    /**
     * Get benchPlayerTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBenchPlayerTeam()
    {
        return $this->benchPlayerTeam;
    }

    /**
     * Получение массива наказаний игроков для вывода в шаблоне
     */
    public function getPunishmentEventArray(){
        $punishments = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->punishmentEvent as $punishment){
            if($punishment->getType() == false){
                $punishments['left'][] = $punishment;
            }else{
                $punishments['right'][] = $punishment;
            }
        }

        $countString = count($punishments['left']) > count($punishments['right']) ? count($punishments['left']) : count($punishments['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($punishments['left'][$i])){
                $result[$i]['left'] = $punishments['left'][$i];
            }
            if(isset($punishments['right'][$i])){
                $result[$i]['right'] = $punishments['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива замен для вывода в шаблоне
     */
    public function getReplacementEventArray(){
        $replacements = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->replacementEvent as $replacement){
            if($replacement->getType() == false){
                $replacements['left'][] = $replacement;
            }else{
                $replacements['right'][] = $replacement;
            }
        }

        $countString = count($replacements['left']) > count($replacements['right']) ? count($replacements['left']) : count($replacements['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($replacements['left'][$i])){
                $result[$i]['left'] = $replacements['left'][$i];
            }
            if(isset($replacements['right'][$i])){
                $result[$i]['right'] = $replacements['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива состава команд для вывода в шаблоне
     */
    public function getPlayerTeamArray(){
        $playerTeams = array(
            'left' => array(),
            'right' => array()
        );

        $playerTeamArray = array();
        $i = 0;

        foreach($this->playerTeam as $playerTeam){
            $playerTeamArray[$i]['amplua'] = $playerTeam->getPlayer()->getAmplua()->getId();
            $playerTeamArray[$i]['playerTeam'] = $playerTeam;
            $i++;
        }

//      Упорядочивание по амплуа
        uasort($playerTeamArray, function($a, $b){
            if ($a['amplua'] == $b['amplua']) {
                return 0;
            }
            return ($a['amplua'] < $b['amplua']) ? -1 : 1;
        });

        foreach($playerTeamArray as $playerTeam){
            if($playerTeam['playerTeam']->getType() == false){
                $playerTeams['left'][] = $playerTeam['playerTeam'];
            }else{
                $playerTeams['right'][] = $playerTeam['playerTeam'];
            }
        }

        $countString = count($playerTeams['left']) > count($playerTeams['right']) ? count($playerTeams['left']) : count($playerTeams['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($playerTeams['left'][$i])){
                $result[$i]['left'] = $playerTeams['left'][$i];
            }
            if(isset($playerTeams['right'][$i])){
                $result[$i]['right'] = $playerTeams['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива запасных для вывода в шаблоне
     */
    public function getBenchPlayerTeamArray(){
        $benchPlayerTeams = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->benchPlayerTeam as $benchPlayerTeam){
            if($benchPlayerTeam->getType() == false){
                $benchPlayerTeams['left'][] = $benchPlayerTeam;
            }else{
                $benchPlayerTeams['right'][] = $benchPlayerTeam;
            }
        }

        $countString = count($benchPlayerTeams['left']) > count($benchPlayerTeams['right']) ? count($benchPlayerTeams['left']) : count($benchPlayerTeams['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($benchPlayerTeams['left'][$i])){
                $result[$i]['left'] = $benchPlayerTeams['left'][$i];
            }
            if(isset($benchPlayerTeams['right'][$i])){
                $result[$i]['right'] = $benchPlayerTeams['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива тренеров для вывода в шаблоне
     */
    public function getBenchCoachArray(){
        $benchCoachs = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->benchCoach as $benchCoach){
            if($benchCoach->getType() == false){
                $benchCoachs['left'][] = $benchCoach;
            }else{
                $benchCoachs['right'][] = $benchCoach;
            }
        }

        $countString = count($benchCoachs['left']) > count($benchCoachs['right']) ? count($benchCoachs['left']) : count($benchCoachs['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($benchCoachs['left'][$i])){
                $result[$i]['left'] = $benchCoachs['left'][$i];
            }
            if(isset($benchCoachs['right'][$i])){
                $result[$i]['right'] = $benchCoachs['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Set final
     *
     * @param integer $final
     * @return Event
     */
    public function setFinal($final)
    {
        $this->final = $final;

        return $this;
    }

    /**
     * Get final
     *
     * @return integer 
     */
    public function getFinal()
    {
        return $this->final;
    }

    public function getFinalText()
    {
        switch($this->final){
            case Event::FINAL_1:{
                $text = 'финал';
            }break;
            case Event::FINAL_1_2:{
                $text = '1/2 финала';
            }break;
            case Event::FINAL_1_4:{
                $text = '1/4 финала';
            }break;
            case Event::FINAL_1_8:{
                $text = '1/8 финала';
            }break;
            case Event::FINAL_1_16:{
                $text = '1/16 финала';
            }break;
            default: {
                $text = 'финал';
            }break;
        }

        return $text;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Event
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Event
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return Event
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }
}
