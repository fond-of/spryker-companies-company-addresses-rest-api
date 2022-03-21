<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class CompaniesCompanyAddressesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider
     */
    protected $companiesCompanyAddressesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
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
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companiesCompanyAddressesRestApiDependencyProvider->provideDependencies(
                $this->containerMock,
            ),
        );
    }
}
