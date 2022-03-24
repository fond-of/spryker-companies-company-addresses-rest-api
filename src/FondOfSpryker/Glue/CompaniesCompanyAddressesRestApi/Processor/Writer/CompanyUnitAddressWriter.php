<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Writer;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapperInterface;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressWriter implements CompanyUnitAddressWriterInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapperInterface
     */
    protected $restCompaniesCompanyAddressRequestMapper;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\RestCompaniesCompanyAddressRequestMapperInterface $restCompaniesCompanyAddressRequestMapper
     * @param \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface $client
     */
    public function __construct(
        RestResponseBuilderInterface $restResponseBuilder,
        RestCompaniesCompanyAddressRequestMapperInterface $restCompaniesCompanyAddressRequestMapper,
        CompaniesCompanyAddressesRestApiClientInterface $client
    ) {
        $this->restCompaniesCompanyAddressRequestMapper = $restCompaniesCompanyAddressRequestMapper;
        $this->client = $client;
        $this->restResponseBuilder = $restResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCompanyUnitAddress(
        RestRequestInterface $restRequest,
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): RestResponseInterface {
        $restCompaniesCompanyAddressDeleteRequestTransfer = $this->restCompaniesCompanyAddressRequestMapper
            ->fromRestRequest($restRequest)
            ->setCompanyUnitAddress($restCompanyUnitAddressAttributesTransfer);

        if ($restCompaniesCompanyAddressDeleteRequestTransfer->getIdCustomer() === null) {
            return $this->restResponseBuilder->buildUserIsNotSpecifiedRestResponse();
        }

        $restCompaniesCompanyAddressResponseTransfer = $this->client
            ->createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $restCompaniesCompanyAddressDeleteRequestTransfer,
            );

        $restCompanyUnitAddressAttributesTransfer = $restCompaniesCompanyAddressResponseTransfer->getCompanyUnitAddress();

        if ($restCompanyUnitAddressAttributesTransfer === null || !$restCompaniesCompanyAddressResponseTransfer->getIsSuccessful()) {
            return $this->restResponseBuilder->buildCouldNotBeCreatedRestResponse();
        }

        return $this->restResponseBuilder->buildCreatedRestResponse($restCompanyUnitAddressAttributesTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateCompanyUnitAddress(
        RestRequestInterface $restRequest,
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): RestResponseInterface {
        $restCompaniesCompanyAddressDeleteRequestTransfer = $this->restCompaniesCompanyAddressRequestMapper
            ->fromRestRequest($restRequest)
            ->setCompanyUnitAddress($restCompanyUnitAddressAttributesTransfer);

        if ($restCompaniesCompanyAddressDeleteRequestTransfer->getIdCustomer() === null) {
            return $this->restResponseBuilder->buildUserIsNotSpecifiedRestResponse();
        }

        $restCompaniesCompanyAddressResponseTransfer = $this->client
            ->updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $restCompaniesCompanyAddressDeleteRequestTransfer,
            );

        $restCompanyUnitAddressAttributesTransfer = $restCompaniesCompanyAddressResponseTransfer->getCompanyUnitAddress();

        if ($restCompanyUnitAddressAttributesTransfer === null || !$restCompaniesCompanyAddressResponseTransfer->getIsSuccessful()) {
            return $this->restResponseBuilder->buildCouldNotBeUpdatedRestResponse();
        }

        return $this->restResponseBuilder->buildUpdatedRestResponse($restCompanyUnitAddressAttributesTransfer);
    }
}
