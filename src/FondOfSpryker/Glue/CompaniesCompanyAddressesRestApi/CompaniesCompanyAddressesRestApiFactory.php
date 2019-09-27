<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use FondOfSpryker\Client\Country\CountryClient;
use FondOfSpryker\Client\Country\CountryClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress\CompanyUnitAddressWriter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress\CompanyUnitAddressWriterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapper;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesCompanyUsersRestApi\Processor\CompanyUser\CompanyUserReader;
use FondOfSpryker\Glue\CompaniesCompanyUsersRestApi\Processor\CompanyUser\CompanyUserReaderInterface;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompaniesCompanyAddressesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyAddress\CompanyUnitAddressWriterInterface
     */
    public function createCompanyUnitAddressWriter(): CompanyUnitAddressWriterInterface
    {
        return new CompanyUnitAddressWriter(
            $this->getResourceBuilder(),
            $this->getCompanyUnitAddressClient(),
            $this->getCompanyClient(),
            $this->getCountryClient(),
            $this->getClient(),
            $this->createCompanyUnitAddressResourceMapper(),
            $this->createRestApiError()
        );
    }

    /**
     * @return \Spryker\Client\Company\CompanyClientInterface
     *
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyUnitAddressClient(): CompanyUnitAddressClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \Spryker\Client\Company\CompanyClientInterface
     *
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyClient(): CompanyClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COMPANY);
    }

    /**
     * @return \FondOfSpryker\Client\Country\CountryClientInterface
     *
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCountryClient(): CountryClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyAddressesRestApiDependencyProvider::CLIENT_COUNTRY);
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
    public function createCompanyUnitAddressResourceMapper(): CompanyUnitAddressResourceMapper
    {
        return new CompanyUnitAddressResourceMapper();
    }
}
