<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Writer;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapperInterface;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressWriterTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressRequestMapperMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyUnitAddressAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Writer\CompanyUnitAddressWriter
     */
    protected $companyUnitAddressWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressRequestMapperMock = $this->getMockBuilder(RestCompaniesCompanyAddressRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUnitAddressAttributesTransferMock = $this->getMockBuilder(RestCompanyUnitAddressAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesResponseTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressWriter = new CompanyUnitAddressWriter(
            $this->restResponseBuilderMock,
            $this->restCompaniesCompanyAddressRequestMapperMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddress(): void
    {
        $idCustomer = 1;

        $this->restCompaniesCompanyAddressRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUnitAddress')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUserIsNotSpecifiedRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->willReturn($this->restCompanyUnitAddressAttributesTransferMock);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCouldNotBeCreatedRestResponse');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCreatedRestResponse')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressWriter->createCompanyUnitAddress(
                $this->restRequestMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressWithoutCustomerId(): void
    {
        $idCustomer = null;

        $this->restCompaniesCompanyAddressRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUnitAddress')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUserIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->clientMock->expects(static::never())
            ->method('createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCouldNotBeCreatedRestResponse');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCreatedRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressWriter->createCompanyUnitAddress(
                $this->restRequestMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressWithInvalidData(): void
    {
        $idCustomer = 1;

        $this->restCompaniesCompanyAddressRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUnitAddress')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUserIsNotSpecifiedRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->willReturn(null);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCouldNotBeCreatedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCreatedRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressWriter->createCompanyUnitAddress(
                $this->restRequestMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddress(): void
    {
        $idCustomer = 1;

        $this->restCompaniesCompanyAddressRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUnitAddress')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUserIsNotSpecifiedRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->willReturn($this->restCompanyUnitAddressAttributesTransferMock);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCouldNotBeUpdatedRestResponse');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUpdatedRestResponse')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressWriter->updateCompanyUnitAddress(
                $this->restRequestMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddressWithoutCustomerId(): void
    {
        $idCustomer = null;

        $this->restCompaniesCompanyAddressRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUnitAddress')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUserIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->clientMock->expects(static::never())
            ->method('updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCouldNotBeUpdatedRestResponse');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUpdatedRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressWriter->updateCompanyUnitAddress(
                $this->restRequestMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddressWithInvalidData(): void
    {
        $idCustomer = 1;

        $this->restCompaniesCompanyAddressRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUnitAddress')
            ->with($this->restCompanyUnitAddressAttributesTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesRequestTransferMock);

        $this->restCompaniesCompanyAddressesRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUserIsNotSpecifiedRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest')
            ->with($this->restCompaniesCompanyAddressesRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->willReturn(null);

        $this->restCompaniesCompanyAddressesResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCouldNotBeUpdatedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUpdatedRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressWriter->updateCompanyUnitAddress(
                $this->restRequestMock,
                $this->restCompanyUnitAddressAttributesTransferMock
            ),
        );
    }
}
