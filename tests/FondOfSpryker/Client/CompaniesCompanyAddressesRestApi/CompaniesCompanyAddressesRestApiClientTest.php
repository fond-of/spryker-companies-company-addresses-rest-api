<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompaniesCompanyAddressesRestApiClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClient
     */
    protected $companiesCompanyAddressesRestApiClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiFactory
     */
    protected $companiesCompanyAddressesRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface
     */
    protected $companiesCompanyAddressesRestApiStubInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->companiesCompanyAddressesRestApiFactoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiStubInterfaceMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiClient = new CompaniesCompanyAddressesRestApiClient();
        $this->companiesCompanyAddressesRestApiClient->setFactory($this->companiesCompanyAddressesRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindDefaultCompanyBusinessUnitByCompanyId(): void
    {
        $this->companiesCompanyAddressesRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createZedCompaniesCompanyAddressesRestApiStub')
            ->willReturn($this->companiesCompanyAddressesRestApiStubInterfaceMock);

        $this->companiesCompanyAddressesRestApiStubInterfaceMock->expects($this->atLeastOnce())
            ->method('findDefaultCompanyBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->assertInstanceOf(
            CompanyBusinessUnitTransfer::class,
            $this->companiesCompanyAddressesRestApiClient->findDefaultCompanyBusinessUnitByCompanyId(
                $this->companyBusinessUnitTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUnitAddress(): void
    {
        $this->companiesCompanyAddressesRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createZedCompaniesCompanyAddressesRestApiStub')
            ->willReturn($this->companiesCompanyAddressesRestApiStubInterfaceMock);

        $this->companiesCompanyAddressesRestApiStubInterfaceMock->expects($this->atLeastOnce())
            ->method('deleteCompanyUnitAddress')
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressResponseTransfer::class,
            $this->companiesCompanyAddressesRestApiClient->deleteCompanyUnitAddress(
                $this->companyUnitAddressTransferMock
            )
        );
    }
}
