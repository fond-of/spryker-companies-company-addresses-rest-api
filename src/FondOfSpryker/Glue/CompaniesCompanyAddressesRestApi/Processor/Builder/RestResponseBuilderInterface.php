<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Builder;

use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUserIsNotSpecifiedRestResponse(): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCouldNotBeDeletedRestResponse(): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildEmptyRestResponse(): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCouldNotBeCreatedRestResponse(): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCouldNotBeUpdatedRestResponse(): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildUpdatedRestResponse(
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCreatedRestResponse(
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): RestResponseInterface;
}
