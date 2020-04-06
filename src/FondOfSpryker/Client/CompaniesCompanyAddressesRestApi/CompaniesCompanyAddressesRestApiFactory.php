<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStub;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompaniesCompanyAddressesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed\CompaniesCompanyAddressesRestApiStubInterface
     */
    public function createZedCompaniesCompanyAddressesRestApiStub(): CompaniesCompanyAddressesRestApiStubInterface
    {
        return new CompaniesCompanyAddressesRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompaniesCompanyAddressesRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
