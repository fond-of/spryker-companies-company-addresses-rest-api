<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiConfig;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyUnitAddressAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUnitAddressAttributesTransferMock = $this->getMockBuilder(RestCompanyUnitAddressAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testBuildUserIsNotSpecifiedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getDetail() === CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_FORBIDDEN;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildUserIsNotSpecifiedRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testBuildCouldNotBeDeletedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_COULD_NOT_DELETED
                            && $restErrorMessageTransfer->getDetail() === CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_COULD_NOT_DELETED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_BAD_REQUEST;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCouldNotBeDeletedRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testBuildCouldNotBeCreatedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_COULD_NOT_CREATED
                            && $restErrorMessageTransfer->getDetail() === CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_COULD_NOT_CREATED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_BAD_REQUEST;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCouldNotBeCreatedRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testBuildCouldNotBeUpdatedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_COULD_NOT_UPDATED
                            && $restErrorMessageTransfer->getDetail() === CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_COULD_NOT_UPDATED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_BAD_REQUEST;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCouldNotBeUpdatedRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testBuildCreatedRestResponse(): void
    {
        $uuid = '24403da9-f449-42b5-a065-7a102455d23f';

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                CompaniesCompanyAddressesRestApiConfig::RESOURCE_COMPANIES_COMPANY_ADDRESSES,
                $uuid,
                $this->restCompanyUnitAddressAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_CREATED)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCreatedRestResponse($this->restCompanyUnitAddressAttributesTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testBuildUpdatedRestResponse(): void
    {
        $uuid = '24403da9-f449-42b5-a065-7a102455d23f';

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restCompanyUnitAddressAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                CompaniesCompanyAddressesRestApiConfig::RESOURCE_COMPANIES_COMPANY_ADDRESSES,
                $uuid,
                $this->restCompanyUnitAddressAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_OK)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildUpdatedRestResponse($this->restCompanyUnitAddressAttributesTransferMock),
        );
    }
}
