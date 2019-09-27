<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompaniesCompanyAddressesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReaderInterface
     */
    public function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->getCompanyBusinessUnitFacade()
        );
    }

    /**
     * @return \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getCompanyBusinessUnitFacade(): CompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }
}
