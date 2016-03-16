<?php 
/**
 * This file extends the league/oauth2-client library
 *
 * It implements a ResourceOwner for Phabricator Installations
 * 
 *
 * @copyright Copyright (c) Ingo Malchow <ingomalchow@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

require __DIR__ . '/vendor/autoload.php';

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class PhabricatorResourceOwner implements ResourceOwnerInterface
{
    /**
     * Domain
     *
     * @var string
     */
    protected $domain;
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;
    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }
    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['result']['phid'] ?: null;
    }
    /**
     * Get resource owner email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->response['result']['primaryEmail'] ?: null;
    }
    /**
     * Get resource owner name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->response['result']['realName'] ?: null;
    }
    /**
     * Get resource owner nickname
     *
     * @return string|null
     */
    public function getNickname()
    {
        return $this->response['result']['userName'] ?: null;
    }
    /**
     * Get resource owner url
     *
     * @return string|null
     */
    public function getUrl()
    {
        return trim($this->domain.'/'.$this->getNickname()) ?: null;
    }
    /**
     * Set resource owner domain
     *
     * @param  string $domain
     *
     * @return ResourceOwner
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }
    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}