<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestCompaniesCompanyAddressRequestMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer
     */
    public function fromRestRequest(
        RestRequestInterface $restRequest
    ): RestCompaniesCompanyAddressesRequestTransfer;
}
