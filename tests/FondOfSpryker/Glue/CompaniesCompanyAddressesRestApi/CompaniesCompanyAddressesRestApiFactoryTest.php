<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\Country\CountryClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface;
use Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface;
use Spryker\Glue\Kernel\Container;

class CompaniesCompanyAddressesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiFactory
     */
    protected $companiesCompanyAddressesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface
     */
    protected $companyBusinessUnitClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface
     */
    protected $companyUnitAddressClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Country\CountryClientInterface
     */
    protected $countryClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitClientInterfaceMock = $this->getMockBuilder(CompanyBusinessUnitClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressClientInterfaceMock = $this->getMockBuilder(CompanyUnitAddressClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyClientInterfaceMock = $this->getMockBuilder(CompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryClientInterfaceMock = $this->getMockBuilder(CountryClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiFactory = new CompaniesCompanyAddressesRestApiFactory();
        $this->companiesCompanyAddressesRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyBusinessUnitClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY_BUSINESS_UNIT)
            ->willReturn($this->companyBusinessUnitClientInterfaceMock);

        $this->assertInstanceOf(
            CompanyBusinessUnitClientInterface::class,
            $this->companiesCompanyAddressesRestApiFactory->getCompanyBusinessUnitClient()
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY_UNIT_ADDRESS)
            ->willReturn($this->companyUnitAddressClientInterfaceMock);

        $this->assertInstanceOf(
            CompanyUnitAddressClientInterface::class,
            $this->companiesCompanyAddressesRestApiFactory->getCompanyUnitAddressClient()
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyClientInterface(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY)
            ->willReturn($this->companyClientInterfaceMock);

        $this->assertInstanceOf(
            CompanyClientInterface::class,
            $this->companiesCompanyAddressesRestApiFactory->getCompanyClient()
        );
    }

    /**
     * @return void
     */
    public function testGetCountryClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COUNTRY)
            ->willReturn($this->countryClientInterfaceMock);

        $this->assertInstanceOf(
            CountryClientInterface::class,
            $this->companiesCompanyAddressesRestApiFactory->getCountryClient()
        );
    }

    /**
     * @return void
     */
    public function testCreatRestApiError(): void
    {
        $this->assertInstanceOf(
            RestApiErrorInterface::class,
            $this->companiesCompanyAddressesRestApiFactory->createRestApiError()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressResourceMapper(): void
    {
        $this->assertInstanceOf(
            CompanyUnitAddressResourceMapperInterface::class,
            $this->companiesCompanyAddressesRestApiFactory->createCompanyUnitAddressResourceMapper()
        );
    }
}
