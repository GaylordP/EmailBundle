<?php

namespace GaylordP\EmailBundle\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use GaylordP\EmailBundle\Entity\Email as EmailEntity;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Event\MessageEvent;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class SetFromListener implements EventSubscriberInterface
{
    private $twig;
    private $em;
    private $parameterEmail;

    public function __construct(
        Environment $twig,
        EntityManagerInterface $em,
        array $parameterEmail
    ) {
        $this->twig = $twig;
        $this->em = $em;
        $this->parameterEmail = $parameterEmail;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            MessageEvent::class => 'onMessage',
        ];
    }

    public function onMessage(MessageEvent $event): void
    {
        $email = $event->getMessage();

        if (!$email instanceof Email) {
            return;
        }

        $email->from(new Address($this->parameterEmail['from_email'], $this->parameterEmail['from_name']));

        $entity = new EmailEntity();
        $entity->setFromEmail($email->getFrom()[0]->getAddress());

        if (true === $this->em->getFilters()->has('deleted_at')) {
            $this->em->getFilters()->disable('deleted_at');
        }
        $entity->setFromUser($this
            ->em
            ->getRepository(User::class)
            ->findOneByEmail($entity->getFromEmail())
        );
        $entity->setToEmail($email->getTo()[0]->getAddress());
        $entity->setToUser($this
            ->em
            ->getRepository(User::class)
            ->findOneByEmail($entity->getToEmail())
        );
        if (true === $this->em->getFilters()->has('deleted_at')) {
            $this->em->getFilters()->enable('deleted_at');
        }

        $entity->setSubject($email->getSubject());
        $entity->setBody($this->twig->render($email->getHtmlTemplate(), $email->getContext()));

        $this->em->persist($entity);
        $this->em->flush();
    }
}
