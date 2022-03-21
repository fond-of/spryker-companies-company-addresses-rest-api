<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface getRepository()
 */
class CompaniesCompanyAddressesRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT);
    }
}
