<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter;

use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUuidFilter implements CompanyUuidFilterInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    public function filterFromRestRequest(RestRequestInterface $restRequest): ?string
    {
        $parentResource = $restRequest->findParentResourceByType(CompaniesCompanyAddressesRestApiConfig::RESOURCE_COMPANIES);

        if ($parentResource === null) {
            return null;
        }

        return $parentResource->getId();
    }
}
