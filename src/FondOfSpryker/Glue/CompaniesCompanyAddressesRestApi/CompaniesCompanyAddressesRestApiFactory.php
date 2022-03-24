<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilder;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Deleter\CompanyUnitAddressDeleter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Deleter\CompanyUnitAddressDeleterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapper;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapperInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapper;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapperInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Writer\CompanyUnitAddressWriter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Writer\CompanyUnitAddressWriterInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClient getClient()
 */
class CompaniesCompanyAddressesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Deleter\CompanyUnitAddressDeleterInterface
     */
    public function createCompanyUnitAddressDeleter(): CompanyUnitAddressDeleterInterface
    {
        return new CompanyUnitAddressDeleter(
            $this->createRestResponseBuilder(),
            $this->createRestCompaniesCompanyAddressDeleteRequestMapper(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Writer\CompanyUnitAddressWriterInterface
     */
    public function createCompanyUnitAddressWriter(): CompanyUnitAddressWriterInterface
    {
        return new CompanyUnitAddressWriter(
            $this->createRestResponseBuilder(),
            $this->createRestCompaniesCompanyAddressRequestMapper(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapperInterface
     */
    protected function createRestCompaniesCompanyAddressDeleteRequestMapper(): RestCompaniesCompanyAddressDeleteRequestMapperInterface
    {
        return new RestCompaniesCompanyAddressDeleteRequestMapper(
            $this->createCustomerIdFilter(),
            $this->createCompanyUuidFilter(),
            $this->createCompanyUnitAddressUuidFilter(),
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapperInterface
     */
    protected function createRestCompaniesCompanyAddressRequestMapper(): RestCompaniesCompanyAddressRequestMapperInterface
    {
        return new RestCompaniesCompanyAddressRequestMapper(
            $this->createCustomerIdFilter(),
            $this->createCompanyUuidFilter(),
            $this->createCompanyUnitAddressUuidFilter(),
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected function createCustomerIdFilter(): CustomerIdFilterInterface
    {
        return new CustomerIdFilter();
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilterInterface
     */
    protected function createCompanyUuidFilter(): CompanyUuidFilterInterface
    {
        return new CompanyUuidFilter();
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilterInterface
     */
    protected function createCompanyUnitAddressUuidFilter(): CompanyUnitAddressUuidFilterInterface
    {
        return new CompanyUnitAddressUuidFilter();
    }
}
