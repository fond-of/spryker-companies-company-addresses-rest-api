<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiRepositoryInterface getRepository()()
 */
class CompaniesCompanyAddressesRestApiFacade extends AbstractFacade implements CompaniesCompanyAddressesRestApiFacadeInterface
{
 /**
  * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
  *
  * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
  */
    public function deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): RestCompaniesCompanyAddressesDeleteResponseTransfer {
        return $this->getFactory()
            ->createCompanyUnitAddressDeleter()
            ->deleteByRestCompaniesCompanyAddressesDeleteRequest($restCompaniesCompanyAddressesDeleteRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        return $this->getFactory()
            ->createCompanyUnitAddressWriter()
            ->createByRestCompaniesCompanyAddressesRequest($restCompaniesCompanyAddressesRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        return $this->getFactory()
            ->createCompanyUnitAddressWriter()
            ->updateByRestCompaniesCompanyAddressesRequest($restCompaniesCompanyAddressesRequestTransfer);
    }
}
