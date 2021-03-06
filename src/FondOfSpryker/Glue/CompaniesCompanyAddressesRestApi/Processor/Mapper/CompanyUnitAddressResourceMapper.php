<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;

class CompanyUnitAddressResourceMapper implements CompanyUnitAddressResourceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer
     */
    public function mapCompanyUnitAddressTransferToRestCompanyUnitAddressAddressAttributesTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): RestCompanyUnitAddressAttributesTransfer {
        return (new RestCompanyUnitAddressAttributesTransfer())
            ->fromArray($companyUnitAddressTransfer->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function mapRestCompanyUnitAddressAttributesTransferToCompanyUnitAddressTransfer(
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): CompanyUnitAddressTransfer {
        return (new CompanyUnitAddressTransfer())->fromArray($restCompanyUnitAddressAttributesTransfer->toArray(), true);
    }
}
