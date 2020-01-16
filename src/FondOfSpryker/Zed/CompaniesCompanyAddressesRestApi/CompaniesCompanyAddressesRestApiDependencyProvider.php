<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Communication\Plugin\CompanyBusinessUnitCompanyUnitAddressExpanderPlugin;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventBridge;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompaniesCompanyAddressesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY_BUSINESS_UNIT = 'FACADE_COMPANY_BUSINESS_UNIT';
    public const FACADE_COMPANY_UNIT_ADDRESS = 'FACADE_COMPANY_UNIT_ADDRESS';
    public const FACADE_EVENT = 'FACADE_EVENT';

    public const PROPEL_QUERY_COMPANY_UNIT_ADDRESS = 'PROPEL_QUERY_COMPANY_UNIT_ADDRESS';

    public const PLUGINS_COMPANY_UNIT_ADDRESS_EXPANDER = 'PLUGINS_COMPANY_UNIT_ADDRESS_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyBusinessUnitFacade($container);
        $container = $this->addCompanyUnitAddressFacade($container);
        $container = $this->addCompanyUnitAddressExpanderPlugins($container);
        $container = $this->addEventFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCompanyUnitAddressPropelQuery($container);

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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_UNIT_ADDRESS] = function (Container $container) {
            return $container->getLocator()->companyUnitAddress()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_UNIT_ADDRESS] = function () {
            return SpyCompanyUnitAddressQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT] = function (Container $container) {
            return new CompaniesCompanyAddressesRestApiToEventBridge($container->getLocator()->event()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_COMPANY_UNIT_ADDRESS_EXPANDER] = function () {
            return $this->getCompanyUnitAddressExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Plugin\CompanyUnitAddressExpanderPluginInterface[]
     */
    protected function getCompanyUnitAddressExpanderPlugins(): array
    {
        return [
            new CompanyBusinessUnitCompanyUnitAddressExpanderPlugin(),
        ];
    }
}
