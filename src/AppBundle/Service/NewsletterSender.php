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

    public $parser;

    /**
     * @DI\Inject("%newsletter_dir%")
     */
    public $newsletterDir;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    private function getValuesFromYaml()
    {
        $values = $this->parser->parse(file_get_contents($this->newsletterDir));

        return $values;
    }

    private function validateEmails($values)
    {
        foreach($values['newsletter']['to'] as $value) {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Invalid email address');
            }
        }
    }

    protected function generateEmail($values)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($values['newsletter']['subject'])
            ->setFrom($values['newsletter']['from'])
            ->setTo($values['newsletter']['to'])
            ->setBody($values['newsletter']['content'],
                'text/html'
            );

        return $message;
    }

    public function sendEmail()
    {
        $values = $this->getValuesFromYaml();
        $this->validateEmails($values);
        $message = $this->generateEmail($values);
        /** @var \Swift_Mailer $resp */
        $resp = $this->mailer->send($message);

        return $resp;
    }
}