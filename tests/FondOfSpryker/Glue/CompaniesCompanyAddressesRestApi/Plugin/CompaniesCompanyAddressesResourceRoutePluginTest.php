<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CompaniesCompanyAddressesResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Plugin\CompaniesCompanyAddressesResourceRoutePlugin
     */
    protected $companiesCompanyAddressesResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionInterfaceMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesResourceRoutePlugin = new CompaniesCompanyAddressesResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionInterfaceMock->expects($this->atLeastOnce())
            ->method('addPost')
            ->willReturn($this->resourceRouteCollectionInterfaceMock);

        $this->resourceRouteCollectionInterfaceMock->expects($this->atLeastOnce())
            ->method('addPatch')
            ->willReturn($this->resourceRouteCollectionInterfaceMock);

        $this->assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->companiesCompanyAddressesResourceRoutePlugin->configure(
                $this->resourceRouteCollectionInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(
            CompaniesCompanyAddressesRestApiConfig::RESOURCE_COMPANIES_COMPANY_ADDRESSES,
            $this->companiesCompanyAddressesResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(
            CompaniesCompanyAddressesRestApiConfig::CONTROLLER_COMPANIES_COMPANY_ADDRESSES,
            $this->companiesCompanyAddressesResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(
            RestCompanyUnitAddressAttributesTransfer::class,
            $this->companiesCompanyAddressesResourceRoutePlugin->getResourceAttributesClassName()
        );
    }

    /**
     * @return void
     */
    public function testGetParentResourceType(): void
    {
        $this->assertSame(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $this->companiesCompanyAddressesResourceRoutePlugin->getParentResourceType()
        );
    }
}
