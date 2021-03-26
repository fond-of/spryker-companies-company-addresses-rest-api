<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation;

use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestApiValidator implements RestApiValidatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $apiErrors;

    /**
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface $apiErrors
     */
    public function __construct(RestApiErrorInterface $apiErrors)
    {
        $this->apiErrors = $apiErrors;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return bool
     */
    public function isCompanyAddress(
        RestRequestInterface $restRequest,
        CompanyTransfer $companyTransfer
    ): bool {
        $companyResource = $restRequest->findParentResourceByType(CompaniesRestApiConfig::RESOURCE_COMPANIES) ?? $restRequest->getResource();

        return $companyTransfer->getUuid() === $companyResource->getId();
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\CompanyUserCollectionTransfer $companyUserCollectionTransfer
     *
     * @return bool
     */
    public function isCustomerCompanyUser(
        RestRequestInterface $restRequest,
        CompanyUserCollectionTransfer $companyUserCollectionTransfer
    ): bool {
        $companyResource = $restRequest->findParentResourceByType(CompaniesRestApiConfig::RESOURCE_COMPANIES) ?? $restRequest->getResource();

        foreach ($companyUserCollectionTransfer->getCompanyUsers() as $companyUser) {
            if ($companyUser->getCompany()->getUuid() === $companyResource->getId()) {
                return true;
            }
        }

        return false;
    }
}
