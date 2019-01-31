<?php

namespace Localfr\UberallBundle\Tests\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Provider\UserProvider;
use Localfr\UberallBundle\Service\Rest\Client\Uberall\UserClient;
use Localfr\UberallBundle\Tests\Service\Rest\UberallClientTest;

class UserClientTest extends UberallClientTest
{
    public function testGetByEmailWithoutEmail()
    {
        $this->expectException('Localfr\UberallBundle\Exception\UserException');
        $this->expectExceptionMessage('Missing email on main contact.');

        $userClient = new UserClient($this->getBrowserMock(), $this->config);
        $userClient->getByEmail(null);
    }

    public function testGetByEmailWithoutResult()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->with($this->equalTo($this->config['base_url'] . '/api/users?query=' . $this->email))
            ->willReturn($responseMock);

        $userClient = new UserClient($browserMock, $this->config);
        $this->assertNull($userClient->getByEmail($this->email));
    }

    public function testGetByEmail()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $userClient = new UserClient($browserMock, $this->config);
        $this->assertEquals($this->getUser(), $userClient->getByEmail($this->email));
    }

    public function testCreateWithExistingUser()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $userClient = new UserClient($browserMock, $this->config);
        $this->assertEquals($this->getUser(), $userClient->create($this->getUserProvider()));
    }

    public function testCreateWithError()
    {
        $message = 'create user error message';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->exactly(2))
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent($message));

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $browserMock->expects($this->once())
            ->method('post')
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\UserException');
        $this->expectExceptionMessage(sprintf('Error on user creation : %s', $message));

        $userClient = new UserClient($browserMock, $this->config);
        $userClient->create($this->getUserProvider());
    }

    public function testCreateWithSuccess()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->exactly(2))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getErrorJsonContent(), $this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $browserMock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo($this->config['base_url'] . '/api/users'),
                $this->equalTo([
                    'Cache-Control' => 'no-cache',
                    'content-type' => 'application/json',
                    'privateKey' => $this->config['private_key']
                ]),
                $this->isJson()
            )
            ->willReturn($responseMock);

        $userClient = new UserClient($browserMock, $this->config);
        $this->assertEquals($this->getUser(), $userClient->create($this->getUserProvider()));
    }

    public function testRemoveWithError()
    {
        $id = 8;
        $message = 'remove user error message';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once(1))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getErrorJsonContent($message));

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('delete')
            ->with($this->config['base_url'] . '/api/users/' . $id)
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\UserException');
        $this->expectExceptionMessage(sprintf('Error on user deletion : %s', $message));

        $userClient = new UserClient($browserMock, $this->config);
        $userClient->remove($id);
    }

    public function testRemoveWithSuccess()
    {
        $id = 8;
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once(1))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('delete')
            ->willReturn($responseMock);

        $userClient = new UserClient($browserMock, $this->config);
        $this->assertNull($userClient->remove($id));
    }

    /**
     * @return UserProvider
     */
    private function getUserProvider()
    {
        return new UserProvider([
            'email' => $this->email
        ]);
    }
}
