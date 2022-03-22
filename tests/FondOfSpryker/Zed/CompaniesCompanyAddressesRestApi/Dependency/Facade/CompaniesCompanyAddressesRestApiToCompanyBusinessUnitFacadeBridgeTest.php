<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;

class CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyBusinessUnitById(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->with($this->companyBusinessUnitTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->bridge->getCompanyBusinessUnitById($this->companyBusinessUnitTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFindDefaultBusinessUnitByCompanyId(): void
    {
        $idCompany = 1;

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findDefaultBusinessUnitByCompanyId')
            ->with($idCompany)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->bridge->findDefaultBusinessUnitByCompanyId($idCompany),
        );
    }
}
