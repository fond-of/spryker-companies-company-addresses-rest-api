<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    public function deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequestAction(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): RestCompaniesCompanyAddressesDeleteResponseTransfer {
        return $this->getFacade()->deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
            $restCompaniesCompanyAddressesDeleteRequestTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function createCompanyUnitAddressByRestCompaniesCompanyAddressesRequestAction(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        return $this->getFacade()->createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
            $restCompaniesCompanyAddressesRequestTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer
     */
    public function updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequestAction(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): RestCompaniesCompanyAddressesResponseTransfer {
        return $this->getFacade()->updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
            $restCompaniesCompanyAddressesRequestTransfer,
        );
    }
}
