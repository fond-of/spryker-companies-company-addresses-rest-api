<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper;

use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilterInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilterInterface;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestCompaniesCompanyAddressRequestMapper implements RestCompaniesCompanyAddressRequestMapperInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected $customerIdFilter;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilterInterface
     */
    protected $companyUuidFilter;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilterInterface
     */
    protected $companyUnitAddressUuidFilter;

    /**
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CustomerIdFilterInterface $customerIdFilter
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUuidFilterInterface $companyUuidFilter
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter\CompanyUnitAddressUuidFilterInterface $companyUnitAddressUuidFilter
     */
    public function __construct(
        CustomerIdFilterInterface $customerIdFilter,
        CompanyUuidFilterInterface $companyUuidFilter,
        CompanyUnitAddressUuidFilterInterface $companyUnitAddressUuidFilter
    ) {
        $this->customerIdFilter = $customerIdFilter;
        $this->companyUuidFilter = $companyUuidFilter;
        $this->companyUnitAddressUuidFilter = $companyUnitAddressUuidFilter;
    }

    /**
     * @inheritDoc
     */
    public function fromRestRequest(RestRequestInterface $restRequest): RestCompaniesCompanyAddressesRequestTransfer
    {
        return (new RestCompaniesCompanyAddressesRequestTransfer())
            ->setIdCustomer($this->customerIdFilter->filterFromRestRequest($restRequest))
            ->setCompanyUuid($this->companyUuidFilter->filterFromRestRequest($restRequest))
            ->setCompanyUnitAddressUuid($this->companyUnitAddressUuidFilter->filterFromRestRequest($restRequest));
    }
}
