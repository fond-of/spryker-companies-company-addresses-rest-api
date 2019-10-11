<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CompaniesCompanyAddressesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COMPANY_BUSINESS_UNIT = 'CLIENT_COMPANY_BUSINESS_UNIT';
    public const CLIENT_COMPANY = 'CLIENT_COMPANY';
    public const CLIENT_COMPANY_UNIT_ADDRESS = 'CLIENT_COMPANY_UNIT_ADDRESS';
    public const CLIENT_COUNTRY = 'CLIENT_COUNTRY';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCompanyBusinessUnitClient($container);
        $container = $this->addCompanyUnitAddressClient($container);
        $container = $this->addCompanyClient($container);
        $container = $this->addCountryClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyBusinessUnitClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_BUSINESS_UNIT] = static function (Container $container) {
            return $container->getLocator()->companyBusinessUnit()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyUnitAddressClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_UNIT_ADDRESS] = static function (Container $container) {
            return $container->getLocator()->companyUnitAddress()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY] = static function (Container $container) {
            return $container->getLocator()->company()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCountryClient(Container $container): Container
    {
        $container[static::CLIENT_COUNTRY] = static function (Container $container) {
            return $container->getLocator()->country()->client();
        };

        return $container;
    }
}
