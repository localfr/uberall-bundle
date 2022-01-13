<?php

namespace Localfr\UberallBundle\Tests\Uberall;

use Localfr\UberallBundle\Component\Serializer\UberallSerializer;
use Localfr\UberallBundle\Service\Rest\Client\Uberall\{
    BusinessClient,
    LocationClient,
    UberallClient,
    UserClient
};
use Localfr\UberallBundle\Tests\TestCase;

final class UberallClientTest extends TestCase
{
    private UberallClient $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = $this->container->get('localfr.uberall.client');
    }

    public function testClass(): void
    {
        $this->assertInstanceOf(UberallClient::class, $this->client);
    }

    public function testBusinessClient(): void
    {
        $businessClient = $this->client->getBusinessClient();
        $this->assertInstanceOf(BusinessClient::class, $businessClient);
        $this->assertEquals('base_url', $businessClient->getBaseUrl());
    }

    public function testLocationClient(): void
    {
        $this->assertInstanceOf(LocationClient::class, $this->client->getLocationClient());
        $this->assertEquals('base_url', $this->client->getLocationClient()->getBaseUrl());
    }

    public function testUserClient(): void
    {
        $this->assertInstanceOf(UserClient::class, $this->client->getUserClient());
        $this->assertEquals('base_url', $this->client->getUserClient()->getBaseUrl());
    }

    public function testSerializer(): void
    {
        $this->assertTrue($this->container->has('localfr.uberall.serializer'));
        $this->assertInstanceOf(UberallSerializer::class, $this->container->get('localfr.uberall.serializer'));
    }
}
