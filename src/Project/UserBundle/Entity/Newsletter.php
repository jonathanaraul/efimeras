<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Table(name="newsletter")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\NewsletterRepository")
 * @ORM\HasLifecycleCallbacks
 */

class Newsletter
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
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Email")
     * @ORM\JoinTable(name="newsletters_emails",
     *      joinColumns={@ORM\JoinColumn(name="id_newsletter", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_email", referencedColumnName="id")}
     * ) 
     */
    protected $emails; 

    /**
     * @var string
     *
     * @ORM\Column(name="redactor", type="string", length=255, nullable=false)
     */
    private $redactor;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=false)
     */
    private $contenido;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


    public function __construct()
    {
        $this->emails = new ArrayCollection();
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
     * Set asunto
     *
     * @param string $asunto
     * @return Newsletter
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string 
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set redactor
     *
     * @param string $redactor
     * @return Newsletter
     */
    public function setRedactor($redactor)
    {
        $this->redactor = $redactor;

        return $this;
    }

    /**
     * Get redactor
     *
     * @return string 
     */
    public function getRedactor()
    {
        return $this->redactor;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return Newsletter
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Newsletter
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Newsletter
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add emails
     *
     * @param \Project\UserBundle\Entity\Email $emails
     * @return Newsletter
     */
    public function addEmail(\Project\UserBundle\Entity\Email $emails)
    {
        $this->emails[] = $emails;

        return $this;
    }

    /**
     * Remove emails
     *
     * @param \Project\UserBundle\Entity\Email $emails
     */
    public function removeEmail(\Project\UserBundle\Entity\Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmails()
    {
        return $this->emails;
    }
}
