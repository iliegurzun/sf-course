<?php
/**
 * Created by PhpStorm.
 * User: ilie.gurzun
 * Date: 27/8/2015
 * Time: 5:47 PM
 */

namespace AppBundle\EventListener;


use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        if($event->getRequest()->isXmlHttpRequest()) {
//            dump($event);die;
        }

    }
}