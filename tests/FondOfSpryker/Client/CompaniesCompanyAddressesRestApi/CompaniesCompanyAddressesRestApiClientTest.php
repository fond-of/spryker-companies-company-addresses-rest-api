<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

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
}
