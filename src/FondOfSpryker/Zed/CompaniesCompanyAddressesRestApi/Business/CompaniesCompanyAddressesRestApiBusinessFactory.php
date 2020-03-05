<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressWriter;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventInterface;
use Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface;
use Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManagerInterface getEntityManager()
 */
class CompaniesCompanyAddressesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyBusinessUnit\CompanyBusinessUnitReaderInterface
     */
    public function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->getCompanyBusinessUnitFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressReaderInterface
     */
    public function createCompanyUnitAddressReader(): CompanyUnitAddressReaderInterface
    {
        return new CompanyUnitAddressReader(
            $this->getCompanyUnitAddressFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressWriter
     */
    public function createCompanyUnitAddressWriter(): CompanyUnitAddressWriter
    {
        return new CompanyUnitAddressWriter(
            $this->getEntityManager(),
            $this->getEventFacade(),
            $this->getCompanyUnitAddressExpanderPlugins()
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected function getCompanyBusinessUnitFacade(): CompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @throws
     *
     * @return \Spryker\Zed\CompanyUnitAddress\Business\CompanyUnitAddressFacadeInterface
     */
    protected function getCompanyUnitAddressFacade(): CompanyUnitAddressFacadeInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventInterface
     */
    protected function getEventFacade(): CompaniesCompanyAddressesRestApiToEventInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::FACADE_EVENT);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Plugin\CompanyUnitAddressExpanderPluginInterface[]
     */
    protected function getCompanyUnitAddressExpanderPlugins(): array
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::PLUGINS_COMPANY_UNIT_ADDRESS_EXPANDER);
    }
}
