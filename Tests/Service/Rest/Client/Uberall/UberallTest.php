<?php

namespace Localfr\UberallBundle\Tests\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\Uberall\Uberall;
use Localfr\UberallBundle\Tests\Service\Rest\UberallClientTest;

class UberallTest extends UberallClientTest
{
    public function testGetAutologinUrlWithNoEmail()
    {
        $this->expectException('Localfr\UberallBundle\Exception\UserException');
        $this->expectExceptionMessage('Connected user has not email.');

        $uberall = new Uberall($this->getHttpClientMock(), $this->getLoggerMock(), $this->config);
        $uberall->getAutologinUrl(null);
    }

    public function testGetAutologinUrlWithNoExistingUser()
    {
        $userClientMock = $this->getUserClientMock();
        $userClientMock->expects($this->once())
            ->method('getByEmail')
            ->with($this->email)
            ->willReturn(null);

        $this->expectException('Localfr\UberallBundle\Exception\UserException');
        $this->expectExceptionMessage(sprintf('User %s not exist in Uberall.', $this->email));

        $uberall = new Uberall($this->getHttpClientMock(), $this->getLoggerMock(), $this->config);
        $uberall->setUserClient($userClientMock);
        $uberall->getAutologinUrl($this->email);
    }

    public function testGetAutologinUrl()
    {
        $user = new \stdClass();
        $user->managedLocations = [
            'firstLocation'
        ];
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getHttpClientMock();
        $browserMock->expects($this->once())
            ->method('post')
            ->willReturn($responseMock);

        $userClientMock = $this->getUserClientMock();
        $userClientMock->expects($this->once())
            ->method('getByEmail')
            ->with($this->email)
            ->willReturn($user);

        $uberall = new Uberall($browserMock, $this->getLoggerMock(), $this->config);
        $uberall->setUserClient($userClientMock);
        $this->assertEquals(sprintf(
            '%s/fr/app/localfr/locationEdit/%s?access_token=%s',
            $this->config['base_url'],
            $user->managedLocations[0],
            $this->token
        ), $uberall->getAutologinUrl($this->email));
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getUserClientMock()
    {
        return $this->getMockBuilder('Localfr\UberallBundle\Service\Rest\Client\Uberall\UserClient')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
