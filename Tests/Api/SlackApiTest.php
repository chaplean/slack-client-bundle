<?php

namespace  Chaplean\Bundle\SlackClientBundle\Tests\Api;

use Chaplean\Bundle\RestClientBundle\Api\RequestRoute;
use Chaplean\Bundle\RestClientBundle\Api\Response\Failure\InvalidParameterResponse;
use Chaplean\Bundle\SlackClientBundle\Api\SlackApi;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * SlackApiTest.php.
 *
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class SlackApiTest extends MockeryTestCase
{
    /**
     * @var \GuzzleHttp\ClientInterface|\Mockery\MockInterface
     */
    private $client;

    /**
     * @var EventDispatcherInterface|\Mockery\MockInterface
     */
    private $eventDispatcher;

    /**
     * @var SlackApi
     */
    private $api;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->client = \Mockery::mock(ClientInterface::class);
        $this->eventDispatcher = \Mockery::mock(EventDispatcherInterface::class);
        $this->api = new SlackApi($this->client, $this->eventDispatcher, 'url', 'token');

        $this->client->shouldReceive('request')
            ->andReturn(new Response(200));
        $this->eventDispatcher->shouldReceive('dispatch');
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::__construct()
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(SlackApi::class, $this->api);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostRoutes()
    {
        $this->assertInstanceOf(RequestRoute::class, $this->api->postMessage());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postDeleteMessage());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postGetTeamInfos());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postListUsers());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postListGroups());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postListUsersForGroup());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postChannel());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postListChannel());
        $this->assertInstanceOf(RequestRoute::class, $this->api->postChannelInvitation());
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testBuildApiPrefixIsCorrectlyConfigured()
    {
        $this->assertStringStartsWith('url', $this->api->postMessage()->getUrl());
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testAccessTokenCorrectlyConfigured()
    {
        $response = $this->api->postGetTeamInfos()
            ->bindQueryParameters(['token' => 'string'])
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostMessageAllParameters()
    {
        $response = $this->api->postMessage()
            ->bindQueryParameters(
                [
                    'token'           => 'string',
                    'channel'         => 'string',
                    'text'            => 'string',
                    'parse'           => 'string',
                    'link_names'      => true,
                    'unfurl_links'    => true,
                    'unfurl_media'    => true,
                    'username'        => 'string',
                    'as_user'         => true,
                    'icon_url'        => 'string',
                    'icon_emoji'      => 'string',
                    'thread_ts'       => 'string',
                    'reply_broadcast' => true,
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostMessageMinimumParameters()
    {
        $response = $this->api->postMessage()
            ->bindQueryParameters(
                [
                    'channel' => 'string',
                    'text'    => 'string',
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostDeleteMessageAllParameters()
    {
        $response = $this->api->postDeleteMessage()
            ->bindQueryParameters(
                [
                    'token'   => 'string',
                    'channel' => 'string',
                    'ts'      => 'string',
                    'as_user' => true,
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostDeleteMessageMinimumParameters()
    {
        $response = $this->api->postDeleteMessage()
            ->bindQueryParameters(
                [
                    'channel' => 'string',
                    'ts'      => 'string',
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostGetTeamInfosAllParameters()
    {
        $response = $this->api->postGetTeamInfos()
            ->bindQueryParameters(
                [
                    'token' => 'string',
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostGetTeamInfosMinimumParameters()
    {
        $response = $this->api->postGetTeamInfos()
            ->bindQueryParameters([])
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostListUsersAllParameters()
    {
        $response = $this->api->postListUsers()
            ->bindQueryParameters(
                [
                    'token'    => 'string',
                    'presence' => true,
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostListUsersMinimumParameters()
    {
        $response = $this->api->postListUsers()
            ->bindQueryParameters([])
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostListGroupsAllParameters()
    {
        $response = $this->api->postListGroups()
            ->bindQueryParameters(
                [
                    'token'            => 'string',
                    'include_disabled' => true,
                    'include_count'    => true,
                    'include_users'    => true,
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostListGroupsMinimumParameters()
    {
        $response = $this->api->postListGroups()
            ->bindQueryParameters([])
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testListUsersForGroupAllParameters()
    {
        $response = $this->api->postListUsersForGroup()
            ->bindQueryParameters(
                [
                    'token'            => 'string',
                    'usergroup'        => 'string',
                    'include_disabled' => true,
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostListUsersForGroupMinimumParameters()
    {
        $response = $this->api->postListUsersForGroup()
            ->bindQueryParameters(
                [
                    'usergroup' => 'string',
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostChannelAllParameters()
    {
        $response = $this->api->postChannel()
            ->bindQueryParameters(
                [
                    'token'    => 'string',
                    'name'     => 'string',
                    'validate' => true,
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostChannelMinimumParameters()
    {
        $response = $this->api->postChannel()
            ->bindQueryParameters(
                [
                    'name' => 'string',
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostListChannelAllParameters()
    {
        $response = $this->api->postListChannel()
            ->bindQueryParameters(
                [
                    'token'            => 'string',
                    'exclude_archived' => true,
                    'exclude_members'  => true,
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostListChannelMinimumParameters()
    {
        $response = $this->api->postListChannel()
            ->bindQueryParameters([])
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostChannelInvitationAllParameters()
    {
        $response = $this->api->postChannelInvitation()
            ->bindQueryParameters(
                [
                    'token'   => 'string',
                    'channel' => 'string',
                    'user'    => 'string'
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\SlackClientBundle\Api\SlackApi::buildApi()
     *
     * @return void
     */
    public function testPostChannelInvitationMinimumParameters()
    {
        $response = $this->api->postChannelInvitation()
            ->bindQueryParameters(
                [
                    'channel' => 'string',
                    'user'    => 'string'
                ]
            )
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }
}
