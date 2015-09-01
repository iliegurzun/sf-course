<?php
/**
 * Created by PhpStorm.
 * User: ilie.gurzun
 * Date: 27/8/2015
 * Time: 4:49 PM
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class HelloControllerTest
 * @package AppBundle\Tests\Controller
 */
class HelloControllerTest extends KernelTestCase
{
    public function testHelloAction()
    {
        self::bootKernel();
        $controller = static::$kernel->getContainer()->get('hello_controller');
        $response = $controller->indexAction('ilie');
        $this->assertContains('ilie', $response->getContent());
    }
}