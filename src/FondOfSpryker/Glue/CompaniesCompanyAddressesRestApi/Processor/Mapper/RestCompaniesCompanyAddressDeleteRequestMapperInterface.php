<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestCompaniesCompanyAddressDeleteRequestMapperInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer
     */
    public function fromRestRequest(
        RestRequestInterface $restRequest
    ): RestCompaniesCompanyAddressesDeleteRequestTransfer;
}
