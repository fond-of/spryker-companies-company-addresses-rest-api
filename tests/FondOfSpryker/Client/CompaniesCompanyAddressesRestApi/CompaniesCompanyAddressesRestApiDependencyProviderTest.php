<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class CompaniesCompanyAddressesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider
     */
    protected $companiesCompanyAddressesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiDependencyProvider = new CompaniesCompanyAddressesRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companiesCompanyAddressesRestApiDependencyProvider->provideServiceLayerDependencies(
                $this->containerMock
            )
        );
    }
}
