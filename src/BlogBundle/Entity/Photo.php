<?php

namespace BlogBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Photo
 */
class Photo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "application/pdf","image/png","image/jpg","image/jpeg","image/gif" })
     */
    private $file;

    /**
     * @var string
     */
    private $fileDesc;

    /**
     * @var \DateTime
     */
    private $dateAdded;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Photo
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set fileDesc
     *
     * @param string $fileDesc
     *
     * @return Photo
     */
    public function setFileDesc($fileDesc)
    {
        $this->fileDesc = $fileDesc;

        return $this;
    }

    /**
     * Get fileDesc
     *
     * @return string
     */
    public function getFileDesc()
    {
        return $this->fileDesc;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Photo
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
    
    private $post;



    public function setPost(\BlogBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    public function getPost()
    {
        return $this->post;
    }
}

