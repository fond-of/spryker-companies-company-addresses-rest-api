<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleter;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer\CompanyUnitAddressWriter;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepository;
use Spryker\Zed\Kernel\Container;

class CompaniesCompanyAddressesRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface
     */
    protected $eventFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiBusinessFactory
     */
    protected $factory;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompaniesCompanyAddressesRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT)
            ->willReturn($this->companyBusinessUnitFacadeMock);

        static::assertInstanceOf(
            CompanyBusinessUnitReader::class,
            $this->factory->createCompanyBusinessUnitReader(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressDeleter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_EVENT],
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_EVENT],
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
            )->willReturnOnConsecutiveCalls(
                $this->eventFacadeMock,
                $this->companyUnitAddressFacadeMock,
            );

        static::assertInstanceOf(
            CompanyUnitAddressDeleter::class,
            $this->factory->createCompanyUnitAddressDeleter(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressWriter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT],
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
            )
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT],
                [CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS],
            )->willReturnOnConsecutiveCalls(
                $this->companyUnitAddressFacadeMock,
                $this->companyBusinessUnitFacadeMock,
                $this->companyUnitAddressFacadeMock,
            );

        static::assertInstanceOf(
            CompanyUnitAddressWriter::class,
            $this->factory->createCompanyUnitAddressWriter(),
        );
    }
}
