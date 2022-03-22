<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;

class CompaniesCompanyAddressesRestApiStubTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    protected $restCompaniesCompanyAddressesDeleteResponseTransferMock;

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

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteRequestTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompaniesCompanyAddressesDeleteResponseTransferMock = $this->getMockBuilder(RestCompaniesCompanyAddressesDeleteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stub = new CompaniesCompanyAddressesRestApiStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testFindDefaultCompanyBusinessUnitByCompanyId(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/companies-company-addresses-rest-api/gateway/find-default-company-business-unit-by-company-id',
                $this->companyBusinessUnitTransferMock,
            )
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->stub->findDefaultCompanyBusinessUnitByCompanyId(
                $this->companyBusinessUnitTransferMock,
            ),
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
}
