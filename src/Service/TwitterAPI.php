<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAPI
{
    private $CONSUMER_KEY;
    private $CONSUMER_SECRET;

    private $access_token;
    private $access_token_secret;

    private $connection;

    public function __construct()
    {
        $this->CONSUMER_KEY = '';
        $this->CONSUMER_SECRET = '';

        $this->access_token = '';
        $this->access_token_secret = '';

        $this->connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $this->access_token, $this->access_token_secret);
    }

    public function getUserTweets(string $username, int $count = 1, bool $exclude_replies = true)
    {
        return $this->connection->get('statuses/user_timeline', ['screen_name' => $username, 'count' => $count, 'exclude_replies' => $exclude_replies]);
    }
}
