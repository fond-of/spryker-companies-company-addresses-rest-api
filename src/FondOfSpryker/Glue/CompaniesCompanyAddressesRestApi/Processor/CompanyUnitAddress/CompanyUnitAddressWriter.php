<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress;

use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface;
use FondOfSpryker\Client\Country\CountryClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiConfig;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Zed\CompanyUnitAddressesRestApi\Business\CompanyUnitAddress\CompanyUnitAddressMapperInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitsRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitsResponseTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressRequestAttributesTransfer;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyBusinessUnit\CompanyBusinessUnitClientInterface;
use Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUnitAddressWriter implements CompanyUnitAddressWriterInterface
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressRestApi\CompaniesCompanyAddressesRestApiClientInterface
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
     * @var \FondOfSpryker\Client\Country\CountryClientInterface
     */
    protected $countryClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * CompanyUnitAddressWriter constructor.
     *
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Spryker\Client\CompanyUnitAddress\CompanyUnitAddressClientInterface $companyUnitAddressClient
     * @param \Spryker\Client\Company\CompanyClientInterface $companyClient
     * @param \FondOfSpryker\Client\Country\CountryClientInterface $countryClient
     * @param \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClientInterface $companiesCompanyAddressesRestApiClient
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper\CompanyUnitAddressResourceMapperInterface $companyUnitAddressResourceMapper
     * @param \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompanyUnitAddressClientInterface $companyUnitAddressClient,
        CompanyClientInterface $companyClient,
        CountryClientInterface $countryClient,
        CompaniesCompanyAddressesRestApiClientInterface $companiesCompanyAddressesRestApiClient,
        CompanyUnitAddressResourceMapperInterface $companyUnitAddressResourceMapper,
        RestApiErrorInterface $restApiError
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companyUnitAddressClient = $companyUnitAddressClient;
        $this->companiesCompanyAddressesRestApiClient = $companiesCompanyAddressesRestApiClient;
        $this->companyUnitAddressResourceMapper = $companyUnitAddressResourceMapper;
        $this->companyClient = $companyClient;
        $this->countryClient = $countryClient;
        $this->restApiError = $restApiError;
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

        if ($restCompanyUnitAddressAttributesTransfer->getIsDefaultBilling()) {
            $companyUnitAddressTransfer->setFkCompanyBusinessUnit(
                $this->findDefaultCompanyBusinessUnitByCompanyId($companyResponseTransfer->getCompanyTransfer())
            );
        }

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
    ): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addCompanyUnitAddressUuidMissingError($restResponse);
        }

        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())->setUuid($restRequest->getResource()->getId());
        $companyUnitAddressTransfer = $this->companyUnitAddressClient
            ->findCompanyBusinessUnitAddressByUuid($companyUnitAddressTransfer)
            ->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null) {
            return $this->restApiError->addCompanyUnitAdddressNotFoundError($restResponse);
        }

        $companyUnitAddressTransfer->fromArray($restCompanyUnitAddressAttributesTransfer->modifiedToArray(), true);
        $countryTransfer = $this->findCountryByIso2Code($restCompanyUnitAddressAttributesTransfer);
        $companyUnitAddressTransfer->setFkCountry($countryTransfer->getIdCountry());

        if ($restCompanyUnitAddressAttributesTransfer->getIsDefaultBilling()) {
            $companyTransfer = (new CompanyTransfer())->setUuid($this->findCompanyIdentifier($restRequest));
            $companyResponseTransfer = $this->companyClient->findCompanyByUuid($companyTransfer);
            $companyUnitAddressTransfer->setFkCompanyBusinessUnit(
                $this->findDefaultCompanyBusinessUnitByCompanyId($companyResponseTransfer->getCompanyTransfer())
            );
        }

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
     * @return \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\CompanyUnitAddress\RestResourceInterface
     */
    protected function getCompanyUnitAddressResource(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer): RestResourceInterface
    {
        $restCompanyUnitAddressResponseTransferAddressAttributesTransfer = $this
            ->companyUnitAddressResourceMapper
            ->mapCompanyUnitAddressTransferToRestCompanyUnitAddressAddressAttributesTransfer(
                $companyUnitAddressTransfer
            );

        $restResource = $this->restResourceBuilder->createRestResource(
            CompaniesCompanyAddressesRestApiConfig::RESOURCE_COMPANIES_COMPANY_ADDRESSES,
            $restCompanyUnitAddressResponseTransferAddressAttributesTransfer->getUuid(),
            $restCompanyUnitAddressResponseTransferAddressAttributesTransfer
        );

        return $restResource;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return int|null
     */
    protected function findDefaultCompanyBusinessUnitByCompanyId(CompanyTransfer $companyTransfer): ?int
    {
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())->setFkCompany($companyTransfer->getIdCompany());
        $companyBusinessUnitTransfer = $this->companiesCompanyAddressesRestApiClient
            ->findDefaultCompanyBusinessUnitByCompanyId($companyBusinessUnitTransfer);

        if ($companyBusinessUnitTransfer !== null) {
            return $companyBusinessUnitTransfer->getIdCompanyBusinessUnit();
        }

        return null;
    }

}
