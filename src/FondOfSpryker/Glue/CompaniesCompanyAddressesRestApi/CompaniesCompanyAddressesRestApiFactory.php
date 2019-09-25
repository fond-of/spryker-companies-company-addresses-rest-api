<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompaniesCompanyAddressesRestApiFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Client\Company\CompanyClientInterface
     *
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyClient(): CompanyClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY);
    }
}
