<?php

namespace Project\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\ReservationRepository")
 */
class Reservation
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
     * @var \Page
     *
     * @ORM\ManyToOne(targetEntity="Page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page", referencedColumnName="id")
     * })
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=300, nullable=false)
     */
    private $name;
	
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=false)
     */
    private $phone;
	
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="rdate", type="string", length=255, nullable=false)
     */
    private $rdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;
	
    /**
     * @var boolean
     *
     * @ORM\Column(name="checked", type="integer", nullable=false)
     */
     private $checked;
	 
    /**
     * @var integer
     *
     * @ORM\Column(name="lang", type="integer", nullable=false)
     */
    private $lang;

    /**
     * @var integer
     *
     * @ORM\Column(name="tickets", type="integer", nullable=false)
     */
    private $tickets;
	

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
     * @return Reservation
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
     * Set phone
     *
     * @param string $phone
     * @return Reservation
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Reservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set rdate
     *
     * @param string $rdate
     * @return Reservation
     */
    public function setRdate($rdate)
    {
        $this->rdate = $rdate;

        return $this;
    }

    /**
     * Get rdate
     *
     * @return string 
     */
    public function getRdate()
    {
        return $this->rdate;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set checked
     *
     * @param integer $checked
     * @return Reservation
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return integer 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set lang
     *
     * @param integer $lang
     * @return Reservation
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return integer 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set tickets
     *
     * @param integer $tickets
     * @return Reservation
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }

    /**
     * Get tickets
     *
     * @return integer 
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set page
     *
     * @param \Project\UserBundle\Entity\Page $page
     * @return Reservation
     */
    public function setPage(\Project\UserBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Project\UserBundle\Entity\Page 
     */
    public function getPage()
    {
        return $this->page;
    }
}
