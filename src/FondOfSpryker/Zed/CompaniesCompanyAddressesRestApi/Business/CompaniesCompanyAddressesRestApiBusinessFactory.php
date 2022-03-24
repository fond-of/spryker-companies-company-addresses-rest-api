<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleter;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Deleter\CompanyUnitAddressDeleterInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\CompanyUnitAddressMapper;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\CompanyUnitAddressMapperInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\RestCompanyUnitAddressAttributesMapper;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\RestCompanyUnitAddressAttributesMapperInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReader;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer\CompanyUnitAddressWriter;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer\CompanyUnitAddressWriterInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyUnitAddressFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface getRepository()
 */
class CompaniesCompanyAddressesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Writer\CompanyUnitAddressWriterInterface
     */
    public function createCompanyUnitAddressWriter(): CompanyUnitAddressWriterInterface
    {
        return new CompanyUnitAddressWriter(
            $this->createCompanyUnitAddressReader(),
            $this->createCompanyUnitAddressMapper(),
            $this->createRestCompanyUnitAddressAttributesMapper(),
            $this->getCompanyUnitAddressFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected function createCompanyUnitAddressReader(): CompanyUnitAddressReaderInterface
    {
        return new CompanyUnitAddressReader(
            $this->getRepository(),
            $this->getCompanyUnitAddressFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    public function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->getRepository(),
            $this->getCompanyBusinessUnitFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper\CompanyUnitAddressMapperInterface
     */
    protected function createCompanyUnitAddressMapper(): CompanyUnitAddressMapperInterface
    {
        return new CompanyUnitAddressMapper($this->createCompanyBusinessUnitReader());
    }

    protected function createRestCompanyUnitAddressAttributesMapper(): RestCompanyUnitAddressAttributesMapperInterface
    {
        return new RestCompanyUnitAddressAttributesMapper();
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
     * @return \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface
     */
    protected function getCompanyBusinessUnitFacade(): CompaniesCompanyAddressesRestApiToCompanyBusinessUnitFacadeInterface
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
