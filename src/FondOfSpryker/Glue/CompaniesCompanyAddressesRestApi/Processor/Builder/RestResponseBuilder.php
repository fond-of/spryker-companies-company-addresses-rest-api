<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder;

use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiConfig;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUserIsNotSpecifiedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED);

        return $this->buildEmptyRestResponse()
            ->addError($restErrorMessageTransfer);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCouldNotBeDeletedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_COULD_NOT_DELETED)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_COULD_NOT_DELETED);

        return $this->buildEmptyRestResponse()
            ->addError($restErrorMessageTransfer);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildEmptyRestResponse(): RestResponseInterface
    {
        return $this->restResourceBuilder
            ->createRestResponse();
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCouldNotBeCreatedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_COULD_NOT_CREATED)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_COULD_NOT_CREATED);

        return $this->buildEmptyRestResponse()
            ->addError($restErrorMessageTransfer);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCouldNotBeUpdatedRestResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_COULD_NOT_UPDATED)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::ERROR_MESSAGE_COULD_NOT_UPDATED);

        return $this->buildEmptyRestResponse()
            ->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUpdatedRestResponse(
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): RestResponseInterface {
        return $this->buildEmptyRestResponse()
            ->addResource($this->createRestResource($restCompanyUnitAddressAttributesTransfer))
            ->setStatus(Response::HTTP_OK);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCreatedRestResponse(
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): RestResponseInterface {
        return $this->buildEmptyRestResponse()
            ->addResource($this->createRestResource($restCompanyUnitAddressAttributesTransfer))
            ->setStatus(Response::HTTP_CREATED);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function createRestResource(
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): RestResourceInterface {
        return $this->restResourceBuilder
            ->createRestResource(
                CompaniesCompanyAddressesRestApiConfig::RESOURCE_COMPANIES_COMPANY_ADDRESSES,
                $restCompanyUnitAddressAttributesTransfer->getUuid(),
                $restCompanyUnitAddressAttributesTransfer,
            )->setPayload($restCompanyUnitAddressAttributesTransfer);
    }
}
