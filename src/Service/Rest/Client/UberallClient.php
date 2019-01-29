<?php

namespace Localfr\UberallBundle\Service\Rest\Client;

use Buzz\Browser;

class UberallClient
{
    /**
     * @var Browser
     */
    private $browser;

    /**
     * @var array
     */
    private $config;

    /**
     * @param Browser $browser
     * @param array $config
     */
    public function __construct(Browser $browser, array $config)
    {
        $this->browser = $browser;
        $this->config = $config;
    }

    /**
     * @param string $service
     * @param array $headers
     *
     * @return mixed
     */
    public function get(string $service, array $headers = []): \stdClass
    {
        $response = $this->browser->get($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers));

        return json_decode($response->getContent());
    }

    /**
     * @param $service
     * @param $data
     * @param array $headers
     *
     * @return mixed
     */
    public function post(string $service, $data, array $headers = []): \stdClass
    {
        $response = $this->browser->post($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers), $data);

        return json_decode($response->getContent());
    }

    /**
     * @param $service
     * @param array $headers
     *
     * @return mixed
     */
    public function delete(string $service, array $headers = []): \stdClass
    {
        $response = $this->browser->delete($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers));

        return json_decode($response->getContent());
    }

    /**
     * @param $service
     * @param $data
     * @param array $headers
     *
     * @return mixed
     */
    public function patch(string $service, $data, $headers = []): \stdClass
    {
        $response = $this->browser->patch($this->getBaseUrl() . $service, array_merge($this->getDefaultHeaders(), $headers), $data);

        return json_decode($response->getContent());
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->config['base_url'];
    }

    /**
     * @return array
     */
    private function getDefaultHeaders()
    {
        return [
            'Cache-Control' => 'no-cache',
            'content-type' => 'application/json',
            'privateKey' => $this->config['private_key']
        ];
    }
}
