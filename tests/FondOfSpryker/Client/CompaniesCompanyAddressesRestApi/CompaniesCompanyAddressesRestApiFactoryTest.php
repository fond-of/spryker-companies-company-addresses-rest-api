<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface;
use Spryker\Client\Kernel\Container;

class CompaniesCompanyAddressesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiFactory
     */
    protected $companiesCompanyAddressesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiFactory = new CompaniesCompanyAddressesRestApiFactory();
        $this->companiesCompanyAddressesRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompaniesCompanyAddressesRestApiStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        $this->assertInstanceOf(
            CompaniesCompanyAddressesRestApiStubInterface::class,
            $this->companiesCompanyAddressesRestApiFactory->createZedCompaniesCompanyAddressesRestApiStub(),
        );
    }
}
