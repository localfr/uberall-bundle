<?php

namespace Localfr\UberallBundle\Tests\Service\Rest;

use Buzz\Message\Response;
use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UberallClientTest extends TestCase
{
    /**
     * @var array
     */
    protected $config = [
        'base_url' => 'http://my-base-url.com',
        'private_key' => 'my-private-key'
    ];

    /**
     * @var array
     */
    private $header = [
        'Cache-Control' => 'no-cache',
        'content-type' => 'application/json'
    ];

    /**
     * @var string
     */
    protected $token = 'my-token';

    /**
     * @var string
     */
    protected $email = 'my-email@lmy-website.com';

    /**
     * @var int
     */
    protected $locationIdentifier = 88888;

    /**
     * @var string
     */
    protected $locationName = 'my location name';

    /**
     * @var string
     */
    protected $businessName = 'my business name';

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->header['privateKey'] = $this->config['private_key'];
    }

    /**
     * @dataProvider restParamsSamples
     */
    public function testMethods($method, $uri, $json = null)
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode(new \stdClass()));

        $browserMock = $this->getBrowserMock();

        if ($json) {
            $json = json_encode($json);
            $browserMock->expects($this->once())
                ->method($method)
                ->with(
                    $this->equalTo($this->config['base_url'] . $uri),
                    $this->equalTo($this->header),
                    $this->equalTo($json)
                )
                ->willReturn($responseMock);
        } else {
            $json = [];
            $browserMock->expects($this->once())
                ->method($method)
                ->with(
                    $this->equalTo($this->config['base_url'] . $uri),
                    $this->equalTo($this->header)
                )
                ->willReturn($responseMock);
        }

        $uberallClient = new UberallClient($browserMock, $this->getMonologMock(), $this->config);
        $this->assertInstanceOf('stdClass', $uberallClient->$method($uri, $json, []));
    }

    public function testGetBaseUrl()
    {
        $uberallClient = new UberallClient($this->getBrowserMock(), $this->getMonologMock(), $this->config);
        $this->assertEquals($this->config['base_url'], $uberallClient->getBaseUrl());
    }

    public function testGenerateUserAccessTokenWithoutEmail()
    {
        $this->expectException('Localfr\UberallBundle\Exception\UnsolvedTokenException');
        $this->expectExceptionMessage('Email is required.');
        $uberallClient = new UberallClient($this->getBrowserMock(), $this->getMonologMock(), $this->config);
        $uberallClient->getAccessToken(null);
    }

    public function testGenerateUserAccessTokenWithError()
    {
        $errorMsg = 'my error message';
        $this->expectException('Localfr\UberallBundle\Exception\UnsolvedTokenException');
        $this->expectExceptionMessage(sprintf('Unable to get the uberall token, due to the following error %s', $errorMsg));
        $this->expectExceptionCode(Response::HTTP_INTERNAL_SERVER_ERROR);

        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent($errorMsg));

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('post')
            ->willReturn($responseMock);

        $uberallClient = new UberallClient($browserMock, $this->getMonologMock(), $this->config);
        $uberallClient->getAccessToken('my-email@my-website.com');
    }

    public function testGenerateUserAccessToken()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('post')
            ->willReturn($responseMock);

        $uberallClient = new UberallClient($browserMock, $this->getMonologMock(), $this->config);
        $this->assertEquals($this->token, $uberallClient->getAccessToken('my-email@my-website.com'));
    }

    public function restParamsSamples()
    {
        return [
            [
                'get',
                'my-uri'
            ],
            [
                'post',
                'my-uri',
                ['my-data-key' => 'my-value']
            ],
            [
                'patch',
                'my-uri',
                ['my-data-key' => 'my-value']
            ],
            [
                'delete',
                'my-uri'
            ]
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getBrowserMock()
    {
        return $this->getMockBuilder('Buzz\Browser')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getMonologMock()
    {
        return $this->getMockBuilder('Monolog\Logger')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getResponseMock()
    {
        return $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param string $message
     * @return string
     */
    protected function getErrorJsonContent($message = null)
    {
        $jsonMessage = "";
        if ($message) {
            $jsonMessage = sprintf(',"message":"%s"', $message);
        }

        return sprintf('{"status":"ERROR","response":{"count":1}%s}', $jsonMessage);
    }

    /**
     * @param int $count
     * @return string
     */
    protected function getSuccessJsonContent($count = 1)
    {
        $response = new \stdClass();
        $response->count = $count;
        $response->access_token = $this->token;
        $response->location = $this->getLocation();
        $response->locations = [$this->getLocation()];
        $response->user = $this->getUser();
        $response->users = [$this->getUser()];
        $response->business = $this->getBusiness();
        $response->businesses = [$this->getBusiness()];

        $stdClass = new \stdClass();
        $stdClass->status = 'SUCCESS';
        $stdClass->response = $response;

        return json_encode($stdClass);
    }

    /**
     * @return \stdClass
     */
    protected function getUser()
    {
        $user = new \stdClass();
        $user->email = $this->email;

        return $user;
    }

    /**
     * @return \stdClass
     */
    protected function getLocation()
    {
        $location = new \stdClass();
        $location->identifier = $this->locationIdentifier;
        $location->name = $this->locationName;

        return $location;
    }

    /**
     * @return \stdClass
     */
    protected function getBusiness()
    {
        $business = new \stdClass();
        $business->name = $this->businessName;

        return $business;
    }
}
