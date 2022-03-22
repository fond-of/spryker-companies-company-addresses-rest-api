<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CompaniesCompanyAddressesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        return parent::provideDependencies($container);
    }
}
