<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;

class CompanyUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReader
     */
    protected $companyUnitAddressReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUnitAddressFacadeInterfaceMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressReader = new CompanyUnitAddressReader(
            $this->companyUnitAddressFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressById(): void
    {
        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('requireIdCompanyUnitAddress')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressTransfer::class,
            $this->companyUnitAddressReader->getCompanyUnitAddressById(
                $this->companyUnitAddressTransferMock
            )
        );
    }
}
