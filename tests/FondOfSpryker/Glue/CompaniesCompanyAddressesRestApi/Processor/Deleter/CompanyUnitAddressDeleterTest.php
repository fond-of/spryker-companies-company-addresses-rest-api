<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Deleter;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapperInterface;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressDeleterTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressDeleteRequestMapperMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesDeleteRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesDeleteResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Deleter\CompanyUnitAddressDeleter
     */
    protected $companyUnitAddressDeleter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressDeleteRequestMapperMock = $this->getMockBuilder(RestCompaniesCompanyAddressDeleteRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteResponseTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressDeleter = new CompanyUnitAddressDeleter(
            $this->restResponseBuilderMock,
            $this->restCompaniesCompanyAddressDeleteRequestMapperMock,
            $this->clientMock
        );
    }

    /**
     * @return void
     */
    public function testDeleteByRestRequest(): void
    {
        $idCustomer = 1;

        $this->restCompaniesCompanyAddressDeleteRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesDeleteRequestTransferMock);

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUserIsNotSpecifiedRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest')
            ->with($this->restCompaniesCompanyAddressesDeleteRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesDeleteResponseTransferMock);

        $this->restCompaniesCompanyAddressesDeleteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCouldNotBeDeletedRestResponse');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildEmptyRestResponse')
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressDeleter->deleteByRestRequest($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testDeleteByRestRequestWithoutCustomerId(): void
    {
        $this->restCompaniesCompanyAddressDeleteRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesDeleteRequestTransferMock);

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUserIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->clientMock->expects(static::never())
            ->method('deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCouldNotBeDeletedRestResponse');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildEmptyRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressDeleter->deleteByRestRequest($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testDeleteByRestRequestWithError(): void
    {
        $idCustomer = 1;

        $this->restCompaniesCompanyAddressDeleteRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restCompaniesCompanyAddressesDeleteRequestTransferMock);

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUserIsNotSpecifiedRestResponse');

        $this->clientMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest')
            ->with($this->restCompaniesCompanyAddressesDeleteRequestTransferMock)
            ->willReturn($this->restCompaniesCompanyAddressesDeleteResponseTransferMock);

        $this->restCompaniesCompanyAddressesDeleteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCouldNotBeDeletedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildEmptyRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUnitAddressDeleter->deleteByRestRequest($this->restRequestMock)
        );
    }
}
