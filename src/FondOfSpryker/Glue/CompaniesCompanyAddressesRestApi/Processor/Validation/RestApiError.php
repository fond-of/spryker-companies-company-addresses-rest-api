<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation;

use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiConfig;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiError implements RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function processCompanyUnitAddressErrorOnCreate(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_FAILED_CREATING_ADDRESS)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::RESPONSE_MESSAGE_FAILED_CREATING_ADDRESS);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyUnitAddressUuidMissingError(RestResponseInterface $restResponse): RestResponseInterface {

        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_BUSINESS_UNIT_UUID_MISSING)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::RESPONSE_MESSAGE_BUSINESS_UNIT_UUID_MISSING);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyUnitAdddressNotFoundError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_BUSINESS_UNIT_ADDRESS_NOT_FOUND)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::RESPONSE_MESSAGE_BUSINESS_UNIT_ADDRESS_NOT_FOUND);

        return $restResponse->addError($restErrorTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function processCompanyUnitAddressErrorOnUpdate(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyAddressesRestApiConfig::RESPONSE_CODE_FAILED_UPDATE_BUSINESS_UNIT_ADDRESS)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesCompanyAddressesRestApiConfig::RESPONSE_MESSAGE_FAILED_UPDATING_BUSINESS_UNIT_ADDRESS);

        return $restResponse->addError($restErrorTransfer);
    }
}
