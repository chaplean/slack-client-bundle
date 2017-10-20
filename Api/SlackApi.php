<?php

namespace Chaplean\Bundle\SlackClientBundle\Api;

use Chaplean\Bundle\RestClientBundle\Api\AbstractApi;
use Chaplean\Bundle\RestClientBundle\Api\Parameter;
use GuzzleHttp\ClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * SlackApi.php.
 *
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class SlackApi extends AbstractApi
{
    protected $token;

    protected $url;

    /**
     * SlackApi constructor.
     *
     * @param ClientInterface          $caller
     * @param EventDispatcherInterface $eventDispatcher
     * @param string                   $url
     * @param string|null              $accessToken
     */
    public function __construct(ClientInterface $caller, EventDispatcherInterface $eventDispatcher, $url, $accessToken = null)
    {
        $this->token = $accessToken;
        $this->url = $url;

        parent::__construct($caller, $eventDispatcher);
    }

    /**
     * Set api actions.
     *
     * @return void
     */
    public function buildApi()
    {
        $this->globalParameters()
            ->urlPrefix($this->url)
            ->queryParameters(
                [
                    'token' => Parameter::string()
                        ->defaultValue($this->token),
                ]
            );

        $this->post('message', 'chat.postMessage')
            ->queryParameters(
                [
                    'token'           => Parameter::string()
                        ->defaultValue($this->token),
                    'channel'         => Parameter::string(),
                    'text'            => Parameter::string(),
                    'parse'           => Parameter::string()
                        ->optional(),
                    'link_names'      => Parameter::bool()
                        ->optional(),
                    'unfurl_links'    => Parameter::bool()
                        ->optional(),
                    'unfurl_media'    => Parameter::bool()
                        ->optional(),
                    'username'        => Parameter::string()
                        ->optional(),
                    'as_user'         => Parameter::bool()
                        ->optional(),
                    'icon_url'        => Parameter::string()
                        ->optional(),
                    'icon_emoji'      => Parameter::string()
                        ->optional(),
                    'thread_ts'       => Parameter::string()
                        ->optional(),
                    'reply_broadcast' => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->post('deleteMessage', 'chat.delete')
            ->queryParameters(
                [
                    'token'   => Parameter::string()
                        ->defaultValue($this->token),
                    'channel' => Parameter::string(),
                    'ts'      => Parameter::string(),
                    'as_user' => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->post('getTeamInfos', 'team.info')
            ->queryParameters(
                [
                    'token' => Parameter::string()
                        ->defaultValue($this->token),
                ]
            );

        $this->post('listUsers', 'users.list')
            ->queryParameters(
                [
                    'token'    => Parameter::string()
                        ->defaultValue($this->token),
                    'presence' => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->post('listGroups', 'usergroups.list')
            ->queryParameters(
                [
                    'token'            => Parameter::string()
                        ->defaultValue($this->token),
                    'include_disabled' => Parameter::bool()
                        ->optional(),
                    'include_count'    => Parameter::bool()
                        ->optional(),
                    'include_users'    => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->post('listUsersForGroup', 'usergroups.users.list')
            ->queryParameters(
                [
                    'token'            => Parameter::string()
                        ->defaultValue($this->token),
                    'usergroup'        => Parameter::string(),
                    'include_disabled' => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->post('channel', 'channels.create')
            ->queryParameters(
                [
                    'token'    => Parameter::string()
                        ->defaultValue($this->token),
                    'name'     => Parameter::string(),
                    'validate' => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->post('listChannel', 'channels.list')
            ->queryParameters(
                [
                    'token'            => Parameter::string()
                        ->defaultValue($this->token),
                    'exclude_archived' => Parameter::bool()
                        ->optional(),
                    'exclude_members'  => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->post('channelInvitation', 'channels.invite')
            ->queryParameters(
                [
                    'token'   => Parameter::string()
                        ->defaultValue($this->token),
                    'channel' => Parameter::string(),
                    'user'    => Parameter::string(),
                ]
            );
    }
}
