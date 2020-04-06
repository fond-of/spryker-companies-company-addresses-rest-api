<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use FondOfSpryker\Client\Country\CountryClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress\CompanyUnitAddressWriter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress\CompanyUnitAddressWriterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapper;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidator;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface;
use Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClient getClient()
 */
class CompaniesCompanyAddressesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress\CompanyUnitAddressWriterInterface
     */
    public function createCompanyUnitAddressWriter(): CompanyUnitAddressWriterInterface
    {
        return new CompanyUnitAddressWriter(
            $this->getResourceBuilder(),
            $this->getCompanyUnitAddressClient(),
            $this->getCompanyBusinessUnitClient(),
            $this->getCompanyClient(),
            $this->getCompanyUserClient(),
            $this->getCountryClient(),
            $this->getClient(),
            $this->createCompanyUnitAddressResourceMapper(),
            $this->createRestApiError(),
            $this->createRestApiValidator()
        );
    }

    /**
     * @return \Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface
     */
    public function getCompanyBusinessUnitClient(): CompanyBusinessUnitClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface
     */
    public function getCompanyUnitAddressClient(): CompanyUnitAddressClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \Spryker\Client\Company\CompanyClientInterface
     */
    public function getCompanyClient(): CompanyClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY);
    }

    /**
     * @return \Spryker\Client\CompanyUser\CompanyUserClientInterface
     */
    public function getCompanyUserClient(): CompanyUserClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY_USER);
    }

    /**
     * @return \FondOfSpryker\Client\Country\CountryClientInterface
     */
    public function getCountryClient(): CountryClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COUNTRY);
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    public function createRestApiValidator(): RestApiValidatorInterface
    {
        return new RestApiValidator($this->createRestApiError());
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    public function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapper
     */
    public function createCompanyUnitAddressResourceMapper(): CompanyUnitAddressResourceMapperInterface
    {
        return new CompanyUnitAddressResourceMapper();
    }
}
