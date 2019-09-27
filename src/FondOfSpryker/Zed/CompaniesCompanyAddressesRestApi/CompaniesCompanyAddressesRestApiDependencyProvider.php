<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi;

use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Communication\Plugin\CompanyUnitAddressesRestApi\CompanyBusinessUnitCompanyUnitAddressMapperPlugin;
use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Communication\Plugin\CompanyUnitAddressesRestApi\CompanyCompanyUnitAddressMapperPlugin;
use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Communication\Plugin\CompanyUnitAddressesRestApi\CompanyUnitAddressMapperPlugin;
use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Dependency\Facade\CompanyUnitAddressesRestApiToCompaniesRestApiFacadeBridge;
use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Dependency\Facade\CompanyUnitAddressesRestApiToCompanyBusinessUnitFacadeBridge;
use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Dependency\Facade\CompanyUnitAddressesRestApiToCompanyBusinessUnitsRestApiFacadeBridge;
use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Dependency\Facade\CompanyUnitAddressesRestApiToCompanyUnitAddressFacadeBridge;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompaniesCompanyAddressesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY_BUSINESS_UNIT = 'FACADE_COMPANY_BUSINESS_UNIT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyBusinessUnitFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyBusinessUnitFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_BUSINESS_UNIT] = function (Container $container) {
            return $container->getLocator()->companyBusinessUnit()->facade();
        };

        return $container;
    }

}
