<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressWriter;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManager;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompaniesCompanyAddressesRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiBusinessFactory
     */
    protected $companiesCompanyAddressesRestApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManager
     */
    protected $companiesCompanyAddressesRestApiEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventInterface
     */
    protected $companiesCompanyAddressesRestApiToEventInterfaceMock;

    /**
     * @var array
     */
    protected $companyUnitAddressExpanderPlugins;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeInterfaceMock = $this->getMockBuilder(CompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeInterfaceMock = $this->getMockBuilder(CompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiEntityManagerMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiToEventInterfaceMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToEventInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressExpanderPlugins = [];

        $this->companiesCompanyAddressesRestApiBusinessFactoryMock = new CompaniesCompanyAddressesRestApiBusinessFactory();
        $this->companiesCompanyAddressesRestApiBusinessFactoryMock->setEntityManager($this->companiesCompanyAddressesRestApiEntityManagerMock);
        $this->companiesCompanyAddressesRestApiBusinessFactoryMock->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT)
            ->willReturn($this->companyBusinessUnitFacadeInterfaceMock);

        $this->assertInstanceOf(
            CompanyBusinessUnitReaderInterface::class,
            $this->companiesCompanyAddressesRestApiBusinessFactoryMock->createCompanyBusinessUnitReader()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS)
            ->willReturn($this->companyUnitAddressFacadeInterfaceMock);

        $this->assertInstanceOf(
            CompanyUnitAddressReader::class,
            $this->companiesCompanyAddressesRestApiBusinessFactoryMock->createCompanyUnitAddressReader()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_EVENT],
                [CompaniesCompanyAddressesRestApiDependencyProvider::PLUGINS_COMPANY_UNIT_ADDRESS_EXPANDER]
            )->willReturnOnConsecutiveCalls(
                $this->companiesCompanyAddressesRestApiToEventInterfaceMock,
                $this->companyUnitAddressExpanderPlugins
            );

        $this->assertInstanceOf(
            CompanyUnitAddressWriter::class,
            $this->companiesCompanyAddressesRestApiBusinessFactoryMock->createCompanyUnitAddressWriter()
        );
    }
}
