<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\Propel\Mapper\CompanyUnitAddressMapper;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManagerInterface getEntityManager()
 */
class CompaniesCompanyAddressesRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressesPropelQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface
     */
    public function createCompanyUniAddressMapper(): CompanyUnitAddressMapperInterface
    {
        return new CompanyUnitAddressMapper();
    }
}
