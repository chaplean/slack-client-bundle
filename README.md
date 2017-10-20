# ChapleanSlackClientBundle

![Codeship Status for chaplean/slack-client-bundle](https://app.codeship.com/projects/3d751e40-97da-0135-4597-4abeebfb6ca6/status?branch=master)

Note: all functions use POST method

# Prerequisites

This version of the bundle requires Symfony 2.8+.

# Installation

## 1. Composer

```bash
composer require chaplean/slack-client-bundle
```


## 2. AppKernel.php

Add
```php
new Chaplean\Bundle\SlackClientBundle\ChapleanSlackClientBundle(),
```


# Configuration

## 1. config.yml
```yml
imports:
    - { resource: '@ChapleanSlackClientBundle/Resources/config/config.yml' }
```

## 2. paramters.yml

```yml
chaplean_slack_client.access_token: 'your access token'
```
