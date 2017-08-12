<?php

namespace BlogBundle\Entity;

/**
 * Likes
 */
class Likes
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $liked;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @var string
     */
    private $browser;

    /**
     * @var string
     */
    private $os;

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
     * Set liked
     *
     * @param integer $liked
     *
     * @return Likes
     */
    public function setLiked($liked)
    {
        $this->liked = $liked;

        return $this;
    }

    /**
     * Get liked
     *
     * @return int
     */
    public function getLiked()
    {
        return $this->liked;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     *
     * @return Likes
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set browser
     *
     * @param string $browser
     *
     * @return Likes
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set os
     *
     * @param string $os
     *
     * @return Likes
     */
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return string
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Likes
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
}

