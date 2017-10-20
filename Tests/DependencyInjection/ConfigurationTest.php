<?php

namespace Tests\Chaplean\Bundle\SlackClientBundle\DependencyInjection;

use Chaplean\Bundle\SlackClientBundle\DependencyInjection\ChapleanSlackClientExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ConfigurationTest.
 *
 * @package   Tests\Chaplean\Bundle\SlackClientBundle\DependencyInjection
 * @author    Matthias - Chaplean <matthias@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ConfigurationTest extends TestCase
{
    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\DependencyInjection\Configuration::getConfigTreeBuilder()
     * @covers \Chaplean\Bundle\SlackClientBundle\DependencyInjection\Configuration::addApiConfiguration()
     *
     * @return void
     */
    public function testFullyDefinedConfig()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanSlackClientExtension();
        $loader->load([['api' => ['url' => 'url', 'access_token' => 'token']]], $container);

        $this->assertEquals('url', $container->getParameter('chaplean_slack_client.api.url'));
        $this->assertEquals('token', $container->getParameter('chaplean_slack_client.api.access_token'));
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\DependencyInjection\Configuration::getConfigTreeBuilder()
     * @covers \Chaplean\Bundle\SlackClientBundle\DependencyInjection\Configuration::addApiConfiguration()
     *
     * @return void
     */
    public function testDefaultConfig()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanSlackClientExtension();
        $loader->load([[]], $container);

        $this->assertEquals('https://slack.com/api/', $container->getParameter('chaplean_slack_client.api.url'));
        $this->assertEquals('%chaplean_slack.access_token%', $container->getParameter('chaplean_slack_client.api.access_token'));
    }
}
