<?php
/**
 * Created by PhpStorm.
 * User: ilie.gurzun
 * Date: 1/9/2015
 * Time: 4:18 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\NewsletterCampaign;
use AppBundle\Service\NewsletterSender;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Parser;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation as DI;

class NewsletterController
{
    /**
     * @DI\Inject("app.newsletter_sender")
     * @var NewsletterSender
     */
    public $newsletterSender;
    /**
     * @DI\Inject("doctrine.orm.entity_manager")
     * @var
     */
    public $em;
    /**
     * @Route("/newsletter/send", name="newsletter_send")
     * @return Response
     */
    public function sendAction()
    {
        $resp = $this->newsletterSender->sendEmail();

        return new Response($resp);
    }

    public function saveAction()
    {
        $newsletter = new NewsletterCampaign();
        $newsletter->setName('testing');
        $this->em->persist($newsletter);
        $this->em->flush();
    }

}