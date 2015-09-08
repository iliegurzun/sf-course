<?php
/**
 * Created by PhpStorm.
 * User: ilie.gurzun
 * Date: 3/9/2015
 * Time: 5:06 PM
 */

namespace AppBundle\Tests\Controller;


use AppBundle\Controller\NewsletterController;
use AppBundle\Entity\NewsletterCampaign;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsletterCampaignTest extends WebTestCase
{
    /**
     * @dataProvider getFixtures
     */
    public function testNewsletterCampaign($fixtures)
    {
        $newsletter = new NewsletterCampaign();
        $this->assertInstanceOf('AppBundle\Entity\NewsletterCampaign', $newsletter);
        $newsletter->setName($fixtures);
        $this->assertEquals($fixtures, $newsletter->getName());

    }

    public function testNewCampaign()
    {
        $controller = new NewsletterController();
        $emMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'persist',
                'flush'
            ))
            ->getMock();
        $emMock->expects($this->any())
            ->method('persist')
            ->will($this->returnValue(null));
        $emMock->expects($this->any())
            ->method('flush')
            ->will($this->returnValue(null));

        $controller->em = $emMock;
        $controller->saveAction();
    }
    public function getFixtures()
    {
        $test = array(
            'name' => 'Test'
        );
        return array(
            $test
        );
    }
}