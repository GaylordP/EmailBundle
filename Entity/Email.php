<?php

namespace GaylordP\EmailBundle\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use GaylordP\UserBundle\Annotation\CreatedAt;

/**
 * Email
 *
 * @ORM\Table("email")
 * @ORM\Entity(repositoryClass="GaylordP\EmailBundle\Repository\EmailRepository")
 */
class Email
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $fromEmail;

    /**
     * @var User
     *
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\User",
     * )
     */
    private $fromUser;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $toEmail;

    /**
     * @var User
     *
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\User",
     * )
     */
    private $toUser;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @CreatedAt
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get from email
     *
     * @return string 
     */
    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    /**
     * Set from email
     * 
     * @param string $fromEmail
     */
    public function setFromEmail(?string $fromEmail)
    {
        $this->fromEmail = strtolower($fromEmail);
    }

    /**
     * Get from user
     *
     * @return User
     */
    public function getFromUser(): ?User
    {
        return $this->fromUser;
    }

    /**
     * Set from user
     *
     * @param User $fromUser
     */
    public function setFromUser(?User $fromUser)
    {
        $this->fromUser = $fromUser;
    }

    /**
     * Get to email
     *
     * @return string
     */
    public function getToEmail(): ?string
    {
        return $this->toEmail;
    }

    /**
     * Set to email
     *
     * @param string $toEmail
     */
    public function setToEmail(?string $toEmail)
    {
        $this->toEmail = strtolower($toEmail);
    }

    /**
     * Get to user
     *
     * @return User
     */
    public function getToUser(): ?User
    {
        return $this->toUser;
    }

    /**
     * Set to user
     *
     * @param User $toUser
     */
    public function setToUser(?User $toUser)
    {
        $this->toUser = $toUser;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param string $subject
     */
    public function setSubject(?string $subject)
    {
        $this->subject = $subject;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * Set body
     * 
     * @param string $body
     */
    public function setBody(?string $body): void
    {
        $this->body = $body;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $date
     */
    public function setCreatedAt(\DateTime $date): void
    {
        $this->createdAt = $date;
    }
}
