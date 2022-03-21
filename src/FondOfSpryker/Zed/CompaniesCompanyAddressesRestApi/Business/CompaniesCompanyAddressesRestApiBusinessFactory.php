<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleter;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleterInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface getRepository()
 */
class CompaniesCompanyAddressesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface
     */
    public function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->getCompanyBusinessUnitFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleterInterface
     */
    public function createCompanyUnitAddressDeleter(): CompanyUnitAddressDeleterInterface
    {
        return new CompanyUnitAddressDeleter(
            $this->getRepository(),
            $this->getEventFacade(),
            $this->getCompanyUnitAddressFacade(),
        );
    }

    /**
     * @return \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected function getCompanyBusinessUnitFacade(): CompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface
     */
    protected function getCompanyUnitAddressFacade(): CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface
     */
    protected function getEventFacade(): CompaniesCompanyAddressesRestApiToEventFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_EVENT);
    }
}
