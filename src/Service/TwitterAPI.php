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
use App\Repository\CompanyRepository;

class TwitterAPI
{
    private $CONSUMER_KEY;
    private $CONSUMER_SECRET;

    private $access_token;
    private $access_token_secret;

    private $connection;

    /**
     * TwitterAPI constructor.
     */
    public function __construct()
    {
        $this->CONSUMER_KEY = 'Pwc5xReQqYAfdYM5lp8cn7Ixq';
        $this->CONSUMER_SECRET = 'Oqr79OW4fH1QvhWfiwvgNhElrzo3S6StUVTRDOlXqHHsgs7RSn';

        $this->access_token = '3374266624-Uy3urxdO2TYnjApidThMg4wtSN3jVIms1Qi4l9H';
        $this->access_token_secret = 'STSJWzpeemZLbAvc61CTV9iuHiAOmdT60re9XQhMANjBF';

        $this->connection = new TwitterOAuth($this->CONSUMER_KEY, $this->CONSUMER_SECRET, $this->access_token, $this->access_token_secret);
    }

    /**
     * @param string $username
     * @param bool $exclude_replies
     * @return null
     */
    public function getUserLastTweet(string $username, bool $exclude_replies = true)
    {
        $tweet = $this->connection->get('statuses/user_timeline', ['screen_name' => $username, 'count' => 1, 'exclude_replies' => $exclude_replies]);
        return $tweet[0] ?? null;
    }

    /**
     * @param string $username
     * @param int $count
     * @param bool $exclude_replies
     * @return array|null|object
     */
    public function getUserTweets(string $username, int $count = 1, bool $exclude_replies = true)
    {
        $tweets = $this->connection->get('statuses/user_timeline', ['screen_name' => $username, 'count' => $count, 'exclude_replies' => $exclude_replies]);
        return $tweets ?? null;
    }

    public function getHomepageTweets(CompanyRepository $company)
    {
        $tweets = [];

        $companies = $company->findAll();

        foreach ($companies as $company) {
            $tweet = $this->getUserLastTweet($company->getTwitter());

            if (!empty($tweet) && !is_null($tweet) && count($tweets) < 3) {
                $tweets[] = $tweet;
            }
        }

        return $tweets;
    }
}