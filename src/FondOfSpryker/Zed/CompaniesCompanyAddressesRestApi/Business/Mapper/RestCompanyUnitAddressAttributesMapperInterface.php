<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;

interface RestCompanyUnitAddressAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer
     */
    public function fromCompanyUnitAddress(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): RestCompanyUnitAddressAttributesTransfer;
}
