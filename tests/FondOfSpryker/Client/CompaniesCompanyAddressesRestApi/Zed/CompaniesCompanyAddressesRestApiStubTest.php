<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;

class CompaniesCompanyAddressesRestApiStubTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompaniesCompanyAddressesResponseTransferMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStub
     */
    protected $stub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteResponseTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesResponseTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new CompaniesCompanyAddressesRestApiStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/companies-company-addresses-rest-api/gateway/delete-company-unit-address-by-rest-companies-company-addresses-delete-request',
                $this->restCompaniesCompanyAddressesDeleteRequestTransferMock,
            )->willReturn($this->restCompaniesCompanyAddressesDeleteResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesDeleteResponseTransferMock,
            $this->stub->deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
                $this->restCompaniesCompanyAddressesDeleteRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/companies-company-addresses-rest-api/gateway/create-company-unit-address-by-rest-companies-company-addresses-request',
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            )->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesResponseTransferMock,
            $this->stub->createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/companies-company-addresses-rest-api/gateway/update-company-unit-address-by-rest-companies-company-addresses-request',
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            )->willReturn($this->restCompaniesCompanyAddressesResponseTransferMock);

        static::assertEquals(
            $this->restCompaniesCompanyAddressesResponseTransferMock,
            $this->stub->updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $this->restCompaniesCompanyAddressesRequestTransferMock,
            ),
        );
    }
}
