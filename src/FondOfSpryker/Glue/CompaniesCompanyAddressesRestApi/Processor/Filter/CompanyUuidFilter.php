<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Filter;

use FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiConfig;
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
        $parentResource = $restRequest->findParentResourceByType(CompaniesRestApiConfig::RESOURCE_COMPANIES_REST_API);

        if ($parentResource === null) {
            return null;
        }

        return $parentResource->getId();
    }
}
