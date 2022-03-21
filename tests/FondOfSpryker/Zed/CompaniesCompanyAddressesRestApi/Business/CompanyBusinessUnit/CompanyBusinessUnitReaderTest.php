<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;

class CompanyBusinessUnitReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReader
     */
    protected $companyBusinessUnitReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var int
     */
    protected $fkCompany;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitFacadeInterfaceMock = $this->getMockBuilder(CompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fkCompany = 1;

        $this->companyBusinessUnitReader = new CompanyBusinessUnitReader(
            $this->companyBusinessUnitFacadeInterfaceMock,
        );
    }

    /**
     * @return void
     */
    public function testFindDefaultCompanyBusinessUnitByCompanyId(): void
    {
        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('requireFkCompany')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($this->fkCompany);

        $this->companyBusinessUnitFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findDefaultBusinessUnitByCompanyId')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->assertInstanceOf(
            CompanyBusinessUnitTransfer::class,
            $this->companyBusinessUnitReader->findDefaultCompanyBusinessUnitByCompanyId(
                $this->companyBusinessUnitTransferMock,
            ),
        );
    }
}
