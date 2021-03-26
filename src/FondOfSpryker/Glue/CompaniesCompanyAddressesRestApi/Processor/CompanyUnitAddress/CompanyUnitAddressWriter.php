<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use FondOfSpryker\Client\Country\CountryClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiConfig;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidatorInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitCollectionTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface;
use Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressWriter implements CompanyUnitAddressWriterInterface
{
    /**
     * @var \Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface
     */
    protected $companyBusinessUnitClient;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface
     */
    protected $companiesCompanyAddressesRestApiClient;

    /**
     * @var \Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface
     */
    protected $companyUnitAddressClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface
     */
    protected $companyUnitAddressResourceMapper;

    /**
     * @var \Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClient;

    /**
     * @var \Spryker\Client\CompanyUser\CompanyUserClientInterface
     */
    protected $companyUserClient;

    /**
     * @var \FondOfSpryker\Client\Country\CountryClientInterface
     */
    protected $countryClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidator;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface $companyUnitAddressClient
     * @param \Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface $companyBusinessUnitClient
     * @param \Spryker\Client\Company\CompanyClientInterface $companyClient
     * @param \Spryker\Client\CompanyUser\CompanyUserClientInterface $companyUserClient
     * @param \FondOfSpryker\Client\Country\CountryClientInterface $countryClient
     * @param \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface $companiesCompanyAddressesRestApiClient
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface $companyUnitAddressResourceMapper
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiValidatorInterface $restApiValidator
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompanyUnitAddressClientInterface $companyUnitAddressClient,
        CompanyBusinessUnitClientInterface $companyBusinessUnitClient,
        CompanyClientInterface $companyClient,
        CompanyUserClientInterface $companyUserClient,
        CountryClientInterface $countryClient,
        CompaniesCompanyAddressesRestApiClientInterface $companiesCompanyAddressesRestApiClient,
        CompanyUnitAddressResourceMapperInterface $companyUnitAddressResourceMapper,
        RestApiErrorInterface $restApiError,
        RestApiValidatorInterface $restApiValidator
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companyBusinessUnitClient = $companyBusinessUnitClient;
        $this->companyUnitAddressClient = $companyUnitAddressClient;
        $this->companiesCompanyAddressesRestApiClient = $companiesCompanyAddressesRestApiClient;
        $this->companyUnitAddressResourceMapper = $companyUnitAddressResourceMapper;
        $this->companyClient = $companyClient;
        $this->companyUserClient = $companyUserClient;
        $this->countryClient = $countryClient;
        $this->restApiError = $restApiError;
        $this->restApiValidator = $restApiValidator;
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
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $companyTransfer = (new CompanyTransfer())->setUuid($this->findCompanyIdentifier($restRequest));
        $companyResponseTransfer = $this->companyClient->findCompanyByUuid($companyTransfer);
        $countryTransfer = $this->findCountryByIso2Code($restCompanyUnitAddressAttributesTransfer);

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->fromArray($restCompanyUnitAddressAttributesTransfer->toArray(), true)
            ->setFkCompany($companyResponseTransfer->getCompanyTransfer()->getIdCompany())
            ->setFkCountry($countryTransfer->getIdCountry());

        $companyBusinessUnitTransfer = $this->findDefaultCompanyBusinessUnitByCompanyId($companyResponseTransfer->getCompanyTransfer());
        $companyUnitAddressTransfer->setFkCompanyBusinessUnit($companyBusinessUnitTransfer->getIdCompanyBusinessUnit());
        $companyBusinessUnitCollectionTransfer = (new CompanyBusinessUnitCollectionTransfer())->addCompanyBusinessUnit($companyBusinessUnitTransfer);
        $companyUnitAddressTransfer->setCompanyBusinessUnits($companyBusinessUnitCollectionTransfer);

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressClient->createCompanyUnitAddress($companyUnitAddressTransfer);

        if (!$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            return $this->restApiError->processCompanyUnitAddressErrorOnCreate($restResponse);
        }

        return $restResponse->addResource(
            $this->getCompanyUnitAddressResource($companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer())
        );
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
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addCompanyUnitAddressUuidMissingError($restResponse);
        }

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())->setUuid($restRequest->getResource()->getId());
        $companyUnitAddressTransfer = $this->companyUnitAddressClient
            ->findCompanyBusinessUnitAddressByUuid($companyUnitAddressTransfer)
            ->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null) {
            return $this->restApiError->addCompanyUnitAddressNotFoundError($restResponse);
        }

        $companyUnitAddressTransfer->fromArray($restCompanyUnitAddressAttributesTransfer->modifiedToArray(), true);
        $countryTransfer = $this->findCountryByIso2Code($restCompanyUnitAddressAttributesTransfer);
        $companyUnitAddressTransfer->setFkCountry($countryTransfer->getIdCountry());

        $companyTransfer = (new CompanyTransfer())->setUuid($this->findCompanyIdentifier($restRequest));
        $companyResponseTransfer = $this->companyClient->findCompanyByUuid($companyTransfer);
        $companyBusinessUnitTransfer = $this->findDefaultCompanyBusinessUnitByCompanyId($companyResponseTransfer->getCompanyTransfer());
        $companyUnitAddressTransfer->setFkCompanyBusinessUnit($companyBusinessUnitTransfer->getIdCompanyBusinessUnit());

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressClient->updateCompanyUnitAddress($companyUnitAddressTransfer);

        if (!$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            return $this->restApiError->processCompanyUnitAddressErrorOnUpdate($restResponse);
        }

        return $restResponse->addResource(
            $this->getCompanyUnitAddressResource($companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer())
        );
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function deleteCompanyUnitAddress(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addCompanyUnitAddressUuidMissingError($restResponse);
        }

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())->setUuid($restRequest->getResource()->getId());
        $companyUnitAddressResponseTransfer = $this->companyUnitAddressClient
            ->findCompanyBusinessUnitAddressByUuid($companyUnitAddressTransfer);

        if ($companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer() === null) {
            return $this->restApiError->addCompanyUnitAddressForCompanyNotFoundError($restResponse);
        }

        $companyTransfer = (new CompanyTransfer())->setIdCompany($companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer()->getFkCompany());
        $companyTransfer = $this->companyClient->getCompanyById($companyTransfer);

        if (!$this->restApiValidator->isCompanyAddress($restRequest, $companyTransfer)) {
            return $this->restApiError->addCompanyUnitAddressForCompanyNotFoundError($restResponse);
        }

        $customerTransfer = (new CustomerTransfer())->setCustomerReference(
            $restRequest->getRestUser()->getNaturalIdentifier()
        );
        $companyUserCollectionTransfer = $this->companyUserClient
            ->getActiveCompanyUsersByCustomerReference($customerTransfer);

        if ($companyUserCollectionTransfer->getCompanyUsers()->count() === 0) {
            return $this->restApiError->addCompanyUnitAddressForCompanyNotFoundError($restResponse);
        }

        if (!$this->restApiValidator->isCustomerCompanyUser($restRequest, $companyUserCollectionTransfer)) {
            return $this->restApiError->addCompanyUnitAddressForCompanyNotFoundError($restResponse);
        }

        $this->companiesCompanyAddressesRestApiClient->deleteCompanyUnitAddress(
            $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer()
        );

        return $restResponse;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    private function findCompanyIdentifier(RestRequestInterface $restRequest): ?string
    {
        $companyResource = $restRequest->findParentResourceByType(CompaniesRestApiConfig::RESOURCE_COMPANIES);
        if ($companyResource !== null) {
            return $companyResource->getId();
        }

        return null;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    protected function findCountryByIso2Code(RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer): CountryTransfer
    {
        $countryTransfer = (new CountryTransfer())->setIso2Code($restCompanyUnitAddressAttributesTransfer->getCountry());

        return $this->countryClient->findCountryByIso2Code($countryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function getCompanyUnitAddressResource(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): RestResourceInterface {
        $restCompanyUnitAddressResponseTransferAddressAttributesTransfer = $this
            ->companyUnitAddressResourceMapper
            ->mapCompanyUnitAddressTransferToRestCompanyUnitAddressAddressAttributesTransfer(
                $companyUnitAddressTransfer
            );

        return $this->restResourceBuilder->createRestResource(
            CompaniesCompanyAddressesRestApiConfig::RESOURCE_COMPANIES_COMPANY_ADDRESSES,
            $restCompanyUnitAddressResponseTransferAddressAttributesTransfer->getUuid(),
            $restCompanyUnitAddressResponseTransferAddressAttributesTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected function findDefaultCompanyBusinessUnitByCompanyId(CompanyTransfer $companyTransfer): CompanyBusinessUnitTransfer
    {
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())->setFkCompany($companyTransfer->getIdCompany());
        $companyBusinessUnitTransfer = $this->companiesCompanyAddressesRestApiClient
            ->findDefaultCompanyBusinessUnitByCompanyId($companyBusinessUnitTransfer);

        return $companyBusinessUnitTransfer;
    }
}
