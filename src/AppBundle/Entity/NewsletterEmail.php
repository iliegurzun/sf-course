<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterEmail
 *
 * @ORM\Table(name="newsletter_email")
 * @ORM\Entity
 */
class NewsletterEmail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * @ORM\ManyToOne(targetEntity="NewsletterCampaign", inversedBy="emails")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     **/
    private $campaign;

    /**
     * @ORM\ManyToOne(targetEntity="Email", inversedBy="campaigns")
     * @ORM\JoinColumn(name="email_id", referencedColumnName="id")
     **/
    private $email;

    /**
     * Set campaign
     *
     * @param \AppBundle\Entity\NewsletterCampaign $campaign
     * @return NewsletterEmail
     */
    public function setCampaign(\AppBundle\Entity\NewsletterCampaign $campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign
     *
     * @return \AppBundle\Entity\NewsletterCampaign 
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Set email
     *
     * @param \AppBundle\Entity\Email $email
     * @return NewsletterEmail
     */
    public function setEmail(\AppBundle\Entity\Email $email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return \AppBundle\Entity\Email 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
