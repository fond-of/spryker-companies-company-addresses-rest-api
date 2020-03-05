<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiFacade;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyBusinessUnitCompanyUnitAddressExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Communication\Plugin\CompanyBusinessUnitCompanyUnitAddressExpanderPlugin
     */
    protected $companyBusinessUnitCompanyUnitAddressExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiFacade
     */
    protected $companiesCompanyAddressesRestApiFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companiesCompanyAddressesRestApiFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitCompanyUnitAddressExpanderPlugin = new CompanyBusinessUnitCompanyUnitAddressExpanderPlugin();
        $this->companyBusinessUnitCompanyUnitAddressExpanderPlugin->setFacade($this->companiesCompanyAddressesRestApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->companiesCompanyAddressesRestApiFacadeMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->assertInstanceOf(
            CompanyUnitAddressTransfer::class,
            $this->companyBusinessUnitCompanyUnitAddressExpanderPlugin->expand(
                $this->companyUnitAddressTransferMock
            )
        );
    }
}
