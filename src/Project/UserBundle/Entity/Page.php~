<?php

namespace Project\UserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Project\UserBundle\Entity\PageRepository")
 * @ORM\HasLifecycleCallbacks
 */

class Page
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
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    private $rank;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=true)
     */
    private $published;
	
    /**
     * @var boolean
     *
     * @ORM\Column(name="special", type="boolean", nullable=false)
     */
    private $special;

    /**
     * @var integer
     *
     * @ORM\Column(name="spacer", type="integer", nullable=true)
     */
    private $spacer;

    /**
     * @var integer
     *
     * @ORM\Column(name="template", type="boolean", nullable=false)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=false)
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="description_meta", type="string", length=255, nullable=false)
     */
    private $descriptionMeta;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="upper_text", type="string", length=255, nullable=false)
     */
    private $upperText;

    /**
     * @var string
     *
     * @ORM\Column(name="lower_text", type="string", length=255, nullable=false)
     */
    private $lowerText;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="friendly_name", type="string", length=255, nullable=false)
     */
    private $friendlyName;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip;

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

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

    /**
     * @var \Background
     *
     * @ORM\ManyToOne(targetEntity="Background")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="background", referencedColumnName="id", nullable=false)
     * })
     */
    private $background;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="pages")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
     */
    protected $category;

    /**
     * @var \Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="theme", referencedColumnName="id", nullable=false)
     * })
     */
    private $theme;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reservacion", type="boolean", nullable=true)
     */
    private $reservacion;

	private $file;
	private $temp;
	private $remove;

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
     * Set remove
     *
     * @param integer $remove
     * @return Page
     */
    public function setRemove($remove)
    {
        $this->remove = $remove;
    
        return $this;
    }

    /**
     * Get remove
     *
     * @return integer 
     */
    public function getRemove()
    {
        return $this->remove;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return Page
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    
        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set published
     *
     * @param integer $published
     * @return Page
     */
    public function setPublished($published)
    {
        $this->published = $published;
    
        return $this;
    }

    /**
     * Get published
     *
     * @return integer 
     */
    public function getPublished()
    {
        return $this->published;
    }


    /**
     * Set special
     *
     * @param integer $special
     * @return Page
     */
    public function setSpecial($special)
    {
        $this->special = $special;
    
        return $this;
    }

    /**
     * Get special
     *
     * @return integer 
     */
    public function getSpecial()
    {
        return $this->special;
    }



    /**
     * Set spacer
     *
     * @param integer $spacer
     * @return Page
     */
    public function setSpacer($spacer)
    {
        $this->spacer = $spacer;
    
        return $this;
    }

    /**
     * Get spacer
     *
     * @return integer 
     */
    public function getSpacer()
    {
        return $this->spacer;
    }

    /**
     * Set template
     *
     * @param integer $template
     * @return Page
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return integer 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Page
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    
        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set descriptionMeta
     *
     * @param string $descriptionMeta
     * @return Page
     */
    public function setDescriptionMeta($descriptionMeta)
    {
        $this->descriptionMeta = $descriptionMeta;
    
        return $this;
    }

    /**
     * Get descriptionMeta
     *
     * @return string 
     */
    public function getDescriptionMeta()
    {
        return $this->descriptionMeta;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Page
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
     * Set upperText
     *
     * @param string $upperText
     * @return Page
     */
    public function setUpperText($upperText)
    {
        $this->upperText = $upperText;
    
        return $this;
    }

    /**
     * Get upperText
     *
     * @return string 
     */
    public function getUpperText()
    {
        return $this->upperText;
    }

    /**
     * Set lowerText
     *
     * @param string $lowerText
     * @return Page
     */
    public function setLowerText($lowerText)
    {
        $this->lowerText = $lowerText;
    
        return $this;
    }

    /**
     * Get lowerText
     *
     * @return string 
     */
    public function getLowerText()
    {
        return $this->lowerText;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Page
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set friendlyName
     *
     * @param string $friendlyName
     * @return Page
     */
    public function setFriendlyName($friendlyName)
    {
        $this->friendlyName = $friendlyName;
    
        return $this;
    }

    /**
     * Get friendlyName
     *
     * @return string 
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }


    /**
     * Set content
     *
     * @param string $content
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Page
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    
        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set user
     *
     * @param \Project\UserBundle\Entity\User $user
     * @return Page
     */
    public function setUser(\Project\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Project\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set background
     *
     * @param \Project\UserBundle\Entity\Background $background
     * @return Page
     */
    public function setBackground(\Project\UserBundle\Entity\Background $background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return \Project\UserBundle\Entity\Background 
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Page
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set reservacion
     *
     * @param boolean $reservacion
     * @return Page
     */
    public function setReservacion($reservacion)
    {
        $this->reservacion = $reservacion;

        return $this;
    }

    /**
     * Get reservacion
     *
     * @return boolean 
     */
    public function getReservacion()
    {
        return $this->reservacion;
    }

    /**
     * Set theme
     *
     * @param \Project\UserBundle\Entity\Theme $theme
     * @return Page
     */
    public function setTheme(\Project\UserBundle\Entity\Theme $theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Project\UserBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Page
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
     * @return Page
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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this -> file = $file;
        // check if we have an old image path
        if (isset($this -> path)) {
            // store the old name to delete after the update
            $this -> temp = $this -> path;
            //$this -> path = null;
        } else {
            $this -> path = 'inicial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this -> getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this -> path = $filename . '.' . $this -> getFile() -> guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this -> getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this -> getFile() -> move($this -> getUploadRootDir(), $this -> path);

        // check if we have an old image
        if (isset($this -> temp)) {
            // delete the old image
            //unlink($this -> getUploadRootDir() . '/' . $this -> temp);
            // clear the temp image path
            $this -> temp = null;
        }
        $this -> file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this -> getAbsolutePath()) {
            unlink($file);
        }
    }
        /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this -> file;
    }

    public function getAbsolutePath() {
        return null === $this -> path ? null : $this -> getUploadRootDir() . '/' . $this -> path;
    }

    public function getWebPath() {
        return null === $this -> path ? null : $this -> getUploadDir() . '/' . $this -> path;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this -> getUploadDir();
    }

    protected function getUploadDir() {
        $directorio = 'page';
        return 'uploads/' . $directorio;
    }

    /**
     * Set category
     *
     * @param \Project\UserBundle\Entity\Category $category
     * @return Page
     */
    public function setCategory(\Project\UserBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Project\UserBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
