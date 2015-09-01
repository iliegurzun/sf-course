<?php
/**
 * Created by PhpStorm.
 * User: ilie.gurzun
 * Date: 1/9/2015
 * Time: 4:18 PM
 */

namespace AppBundle\Controller;

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
     * @Route("/newsletter/send", name="newsletter_send")
     * @return Response
     */
    public function sendAction()
    {
        $resp = $this->newsletterSender->sendEmail();

        return new Response($resp);
    }

}