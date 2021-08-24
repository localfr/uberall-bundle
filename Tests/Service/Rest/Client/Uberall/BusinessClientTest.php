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

        $httpClientMock = $this->getHttpClientMock();
        $httpClientMock->expects($this->once())
            ->method('request')
            ->with('GET', $this->config['base_url'] . '/api/businesses/?query=' . $this->businessName)
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\BusinessException');
        $this->expectExceptionMessage('Error while calling Uberall business API.');

        $businessClient = new BusinessClient($httpClientMock, $this->getLoggerMock(), $this->config);
        $businessClient->create($this->getBusinessProvider());
    }

    public function testCreateWithExistingLocation()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $httpClientMock = $this->getHttpClientMock();
        $httpClientMock->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        $loggerMock = $this->getLoggerMock();
        $loggerMock->expects($this->once())
            ->method('addInfo')
            ->with(sprintf('Business %s already exists', $this->businessName));

        $businessClient = new BusinessClient($httpClientMock, $loggerMock, $this->config);
        $this->assertEquals($this->getBusiness(), $businessClient->create($this->getBusinessProvider()));
    }

    public function testCreateWithCreationError()
    {
        $message = 'create business error message';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->exactly(2))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent(0), $this->getErrorJsonContent($message));

        $httpClientMock = $this->getHttpClientMock();
        $httpClientMock->expects($this->once())
            ->method('request')
            ->method('GET')
            ->willReturn($responseMock);

        $httpClientMock->expects($this->once())
            ->method('request')
            ->with(
                'POST',
                $this->equalTo($this->config['base_url'] . '/api/businesses'),
                [
                    'headers' =>  $this->equalTo([
                        'Cache-Control' => 'no-cache',
                        'content-type' => 'application/json',
                        'privateKey' => $this->config['private_key']
                    ]),
                    'body' => $this->isJson()
                ]
            )
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\BusinessException');
        $this->expectExceptionCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->expectExceptionMessage(sprintf('Error on business creation : %s', $message));

        $businessClient = new BusinessClient($httpClientMock, $this->getLoggerMock(), $this->config);
        $businessClient->create($this->getBusinessProvider());
    }

    public function testCreateWithSuccess()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->exactly(2))
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent(0), $this->getSuccessJsonContent());

        $httpClientMock = $this->getHttpClientMock();
        $httpClientMock->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        $httpClientMock->expects($this->once())
            ->method('request')
            ->with(
                'DELETE',
                $this->equalTo($this->config['base_url'] . '/api/businesses'),
                [
                    'headers' => $this->equalTo([
                        'Cache-Control' => 'no-cache',
                        'content-type' => 'application/json',
                        'privateKey' => $this->config['private_key']
                    ]),
                    'body' => $this->isJson()
                ]
            )
            ->willReturn($responseMock);

        $loggerMock = $this->getLoggerMock();
        $loggerMock->expects($this->once())
            ->method('addInfo')
            ->with(sprintf('Business %s successfully created', $this->businessName));

        $businessClient = new BusinessClient($httpClientMock, $loggerMock, $this->config);
        $this->assertEquals($this->getBusiness(), $businessClient->create($this->getBusinessProvider()));
    }

    public function testRemoveWithError()
    {
        $id = 7;
        $message = 'remove business error message';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getErrorJsonContent($message));

        $httpClientMock = $this->getHttpClientMock();
        $httpClientMock->expects($this->once())
            ->method('request')
            ->with('DELETE', $this->config['base_url'] . '/api/businesses/' . $id)
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\BusinessException');
        $this->expectExceptionMessage(sprintf('Error on business deletion : %s', $message));

        $businessClient = new BusinessClient($httpClientMock, $this->getLoggerMock(), $this->config);
        $businessClient->remove($id);
    }

    public function testRemoveWithSuccess()
    {
        $id = 7;
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent());

        $httpClientMock = $this->getHttpClientMock();
        $httpClientMock->expects($this->once())
            ->method('request')
            ->with('DELETE', $this->config['base_url'] . '/api/businesses/' . $id)
            ->willReturn($responseMock);

        $businessClient = new BusinessClient($httpClientMock, $this->getLoggerMock(), $this->config);
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
