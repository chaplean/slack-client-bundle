<?php

namespace Tests\Chaplean\Bundle\SlackClientBundle\DependencyInjection;

use Chaplean\Bundle\SlackClientBundle\DependencyInjection\ChapleanSlackClientExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ChapleanSlackClientExtensionTest.
 *
 * @package   Tests\Chaplean\Bundle\SlackClientBundle\DependencyInjection
 * @author    Matthias - Chaplean <matthias@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ChapleanSlackClientExtensionTest extends TestCase
{
    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\DependencyInjection\ChapleanSlackClientExtension::load()
     * @covers \Chaplean\Bundle\SlackClientBundle\DependencyInjection\ChapleanSlackClientExtension::setParameters()
     *
     * @return void
     */
    public function testConfigIsLoadedInParameters()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanSlackClientExtension();
        $loader->load([['api' => ['url' => 'url', 'access_token' => 'token']]], $container);

        $this->assertEquals('url', $container->getParameter('chaplean_slack_client.api.url'));
        $this->assertEquals('token', $container->getParameter('chaplean_slack_client.api.access_token'));
    }
}
