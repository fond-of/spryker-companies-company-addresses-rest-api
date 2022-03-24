<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Zed;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;

interface CompaniesCompanyAddressesRestApiStubInterface
{
 /**
  * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
  *
  * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
  */
    public function deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): RestCompaniesCompanyAddressesDeleteResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer;
}
