<?php

namespace Localfr\UberallBundle\Tests\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Provider\LocationProvider;
use Localfr\UberallBundle\Service\Rest\Client\Uberall\LocationClient;
use Localfr\UberallBundle\Tests\Service\Rest\UberallClientTest;
use Symfony\Component\HttpFoundation\Response;

class LocationClientTest extends UberallClientTest
{
    public function testGetLocation()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->with($this->config['base_url'] . '/api/locations/' . $this->locationIdentifier)
            ->willReturn($responseMock);

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $this->assertNull($locationClient->getLocation($this->locationIdentifier));
    }

    public function testGetLocationWithoutResult()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->with($this->config['base_url'] . '/api/locations/' . $this->locationIdentifier)
            ->willReturn($responseMock);

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $this->assertEquals($this->getLocation(), $locationClient->getLocation($this->locationIdentifier));
    }

    public function testGetLocations()
    {
        $maxLocations = 10;
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->with($this->config['base_url'] . '/api/locations?max=' . $maxLocations)
            ->willReturn($responseMock);

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $results = $locationClient->getLocations($maxLocations);
        $this->assertNotEmpty($results);
        $this->assertEquals($this->getLocation(), $results[0]);
    }

    public function testGetLocationsWithoutResult()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->with($this->config['base_url'] . '/api/locations?max=50000')
            ->willReturn($responseMock);

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $this->assertEmpty($locationClient->getLocations());
    }

    public function testCreateWithAPIError()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('get')
            ->with($this->config['base_url'] . '/api/locations?identifier=' . $this->locationIdentifier)
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\LocationException');
        $this->expectExceptionMessage('Error while calling Uberall location API.');

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $locationClient->create($this->getLocationProvider());
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

        $loggerMock = $this->getMonologMock();
        $loggerMock->expects($this->once())
            ->method('addInfo')
            ->with(sprintf('Location %s already exists', $this->locationName));

        $locationClient = new LocationClient($browserMock, $loggerMock, $this->config);
        $this->assertEquals($this->getLocation(), $locationClient->create($this->getLocationProvider()));
    }

    public function testCreateWithCreationError()
    {
        $message = 'create location error message';
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
                $this->equalTo($this->config['base_url'] . '/api/locations'),
                $this->equalTo([
                    'Cache-Control' => 'no-cache',
                    'content-type' => 'application/json',
                    'privateKey' => $this->config['private_key']
                ]),
                $this->isJson()
            )
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\LocationException');
        $this->expectExceptionCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->expectExceptionMessage(sprintf('Error on location creation : %s', $message));

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $locationClient->create($this->getLocationProvider());
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
                $this->equalTo($this->config['base_url'] . '/api/locations'),
                $this->equalTo([
                    'Cache-Control' => 'no-cache',
                    'content-type' => 'application/json',
                    'privateKey' => $this->config['private_key']
                ]),
                $this->isJson()
            )
            ->willReturn($responseMock);

        $loggerMock = $this->getMonologMock();
        $loggerMock->expects($this->once())
            ->method('addInfo')
            ->with(sprintf('Location %s successfully created', $this->locationName));

        $locationClient = new LocationClient($browserMock, $loggerMock, $this->config);
        $this->assertEquals($this->getLocation(), $locationClient->create($this->getLocationProvider()));
    }

    public function testChangeStatusWithError()
    {
        $status = 'disabled';
        $message = 'change location status error';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getErrorJsonContent($message));

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('patch')
            ->with(
                $this->equalTo($this->config['base_url'] . '/api/locations/' . $this->locationIdentifier),
                $this->equalTo([
                    'Cache-Control' => 'no-cache',
                    'content-type' => 'application/json',
                    'privateKey' => $this->config['private_key']
                ]),
                $this->isJson()
            )
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\LocationException');
        $this->expectExceptionCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        $this->expectExceptionMessage(sprintf('Error on location status %s change : %s', $status, $message));

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $locationClient->changeStatus($this->locationIdentifier, $status);
    }

    public function testChangeStatusWithSuccess()
    {
        $status = 'disabled';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturn($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('patch')
            ->with(
                $this->equalTo($this->config['base_url'] . '/api/locations/' . $this->locationIdentifier),
                $this->equalTo([
                    'Cache-Control' => 'no-cache',
                    'content-type' => 'application/json',
                    'privateKey' => $this->config['private_key']
                ]),
                $this->isJson()
            )
            ->willReturn($responseMock);

        $loggerMock = $this->getMonologMock();
        $loggerMock->expects($this->once())
            ->method('addInfo')
            ->with(sprintf('Status of location %d successfully modified (status %s)', $this->locationIdentifier, $status));

        $locationClient = new LocationClient($browserMock, $loggerMock, $this->config);
        $this->assertNull($locationClient->changeStatus($this->locationIdentifier, $status));
    }

    public function testRemoveWithError()
    {
        $message = 'remove location error message';
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getErrorJsonContent($message));

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('delete')
            ->with($this->config['base_url'] . '/api/locations/' . $this->locationIdentifier)
            ->willReturn($responseMock);

        $this->expectException('Localfr\UberallBundle\Exception\LocationException');
        $this->expectExceptionMessage(sprintf('Error on location deletion : %s', $message));

        $locationClient = new LocationClient($browserMock, $this->getMonologMock(), $this->config);
        $locationClient->remove($this->locationIdentifier);
    }

    public function testRemoveWithSuccess()
    {
        $responseMock = $this->getResponseMock();
        $responseMock->expects($this->once())
            ->method('getContent')
            ->willReturnOnConsecutiveCalls($this->getSuccessJsonContent());

        $browserMock = $this->getBrowserMock();
        $browserMock->expects($this->once())
            ->method('delete')
            ->with($this->config['base_url'] . '/api/locations/' . $this->locationIdentifier)
            ->willReturn($responseMock);

        $loggerMock = $this->getMonologMock();
        $loggerMock->expects($this->once())
            ->method('addInfo')
            ->with(sprintf('Location %d successfully deleted', $this->locationIdentifier));

        $locationClient = new LocationClient($browserMock, $loggerMock, $this->config);
        $this->assertNull($locationClient->remove($this->locationIdentifier));
    }

    /**
     * @return LocationProvider
     */
    private function getLocationProvider()
    {
        return new LocationProvider([
            'identifier' => $this->locationIdentifier,
            'name' => $this->locationName
        ]);
    }
}
