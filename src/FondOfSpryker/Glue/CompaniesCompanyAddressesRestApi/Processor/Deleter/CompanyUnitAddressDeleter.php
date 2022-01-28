<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Deleter;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressDeleter implements CompanyUnitAddressDeleterInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapperInterface
     */
    protected $restCompaniesCompanyAddressDeleteRequestMapper;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressDeleteRequestMapperInterface $restCompaniesCompanyAddressDeleteRequestMapper
     * @param \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface $client
     */
    public function __construct(
        RestResponseBuilderInterface $restResponseBuilder,
        RestCompaniesCompanyAddressDeleteRequestMapperInterface $restCompaniesCompanyAddressDeleteRequestMapper,
        CompaniesCompanyAddressesRestApiClientInterface $client
    ) {
        $this->restCompaniesCompanyAddressDeleteRequestMapper = $restCompaniesCompanyAddressDeleteRequestMapper;
        $this->client = $client;
        $this->restResponseBuilder = $restResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function deleteByRestRequest(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restCompaniesCompanyAddressDeleteRequestTransfer = $this->restCompaniesCompanyAddressDeleteRequestMapper
            ->fromRestRequest($restRequest);

        if ($restCompaniesCompanyAddressDeleteRequestTransfer->getIdCustomer() === null) {
            return $this->restResponseBuilder->buildUserIsNotSpecifiedRestResponse();
        }

        $restCompaniesCompanyAddressDeleteResponseTransfer = $this->client
            ->deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest($restCompaniesCompanyAddressDeleteRequestTransfer);

        if (!$restCompaniesCompanyAddressDeleteResponseTransfer->getIsSuccessful()) {
            return $this->restResponseBuilder->buildCouldNotBeDeletedRestResponse();
        }

        return $this->restResponseBuilder->buildEmptyRestResponse();
    }
}
