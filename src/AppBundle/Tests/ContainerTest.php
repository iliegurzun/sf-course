<?php

class TestService
{
}

use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testContainer()
    {
        $container = new ContainerBuilder();
        $container->register('test_service', 'TestService');

        $this->assertInstanceof(
            'TestService',
            $container->get('test_service')
        );

    }
}