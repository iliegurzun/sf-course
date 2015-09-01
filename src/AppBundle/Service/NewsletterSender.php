<?php
/**
 * Created by PhpStorm.
 * User: ilie.gurzun
 * Date: 1/9/2015
 * Time: 4:59 PM
 */

namespace AppBundle\Service;

use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\Yaml\Parser;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @Service("app.newsletter_sender")
 *
 */
class NewsletterSender
{
    /**
     * @DI\Inject("mailer")
     * @var \Swift_Mailer
     */
    public $mailer;

    public function sendEmail()
    {
        $yaml = new Parser();
        $values = $yaml->parse(file_get_contents(__DIR__ . '/../Resources/config/newsletter.yml'));
        foreach($values['newsletter']['to'] as $value) {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Invalid email address');
            }
        }
        $message = \Swift_Message::newInstance()
            ->setSubject($values['newsletter']['subject'])
            ->setFrom('ilie.gurzun@emag.ro')
            ->setTo($values['newsletter']['to'])
            ->setBody('test',
                'text/html'
            );
        /** @var \Swift_Mailer $resp */
        $resp = $this->mailer->send($message);

        return $resp;
    }
}