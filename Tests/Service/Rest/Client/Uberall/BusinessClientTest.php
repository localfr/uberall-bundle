<?php

namespace Localfr\UberallBundle\Tests\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Provider\BusinessProvider;
use Localfr\UberallBundle\Service\Rest\Client\Uberall\BusinessClient;
use Localfr\UberallBundle\Tests\Service\Rest\UberallClientTest;
use Symfony\Component\HttpFoundation\Response;

class BusinessClientTest extends UberallClientTest
{
    public function testCreateWithAPIError()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->with($this->config['base_url'] . '/api/businesses/?query=' . $this->businessName)
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\BusinessException');
        $this->expectExceptionMessage('Error while calling Uberall business API.');

        $businessClient = new BusinessClient($browserMock, $this->config);
        $businessClient->create($this->getBusinessProvider());
    }

    public function testCreateWithExistingLocation()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $businessClient = new BusinessClient($browserMock, $this->config);
        $this->assertEquals($this->getBusiness(), $businessClient->create($this->getBusinessProvider()));
    }

    public function testCreateWithCreationError()
    {
        $message = 'create business error message';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->exactly(2))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent(0), $this->getErrorJsonContent($message));

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $browserMock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo($this->config['base_url'] . '/api/businesses'),
                $this->equalTo([
                    'Cache-Control' => 'no-cache',
                    'content-type' => 'application/json',
                    'privateKey' => $this->config['private_key']
                ]),
                $this->isJson()
            )
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\BusinessException');
        $this->expectExceptionCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->expectExceptionMessage(sprintf('Error on business creation : %s', $message));

        $businessClient = new BusinessClient($browserMock, $this->config);
        $businessClient->create($this->getBusinessProvider());
    }

    public function testCreateWithSuccess()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->exactly(2))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent(0), $this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->willReturn($responseMock);

        $browserMock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo($this->config['base_url'] . '/api/businesses'),
                $this->equalTo([
                    'Cache-Control' => 'no-cache',
                    'content-type' => 'application/json',
                    'privateKey' => $this->config['private_key']
                ]),
                $this->isJson()
            )
            ->willReturn($responseMock);

        $businessClient = new BusinessClient($browserMock, $this->config);
        $this->assertEquals($this->getBusiness(), $businessClient->create($this->getBusinessProvider()));
    }

    public function testRemoveWithError()
    {
        $id = 7;
        $message = 'remove business error message';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once(1))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getErrorJsonContent($message));

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('delete')
            ->with($this->config['base_url'] . '/api/businesses/' . $id)
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\BusinessException');
        $this->expectExceptionMessage(sprintf('Error on business deletion : %s', $message));

        $businessClient = new BusinessClient($browserMock, $this->config);
        $businessClient->remove($id);
    }

    public function testRemoveWithSuccess()
    {
        $id = 7;
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once(1))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('delete')
            ->with($this->config['base_url'] . '/api/businesses/' . $id)
            ->willReturn($responseMock);

        $businessClient = new BusinessClient($browserMock, $this->config);
        $this->assertNull($businessClient->remove($id));
    }

    /**
     * @return BusinessProvider
     */
    private function getBusinessProvider()
    {
        return new BusinessProvider([
            'name' => $this->businessName
        ]);
    }
}
