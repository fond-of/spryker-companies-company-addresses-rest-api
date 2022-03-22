<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiFactory getFactory()
 */
class CompaniesCompanyAddressesRestApiClient extends AbstractClient implements CompaniesCompanyAddressesRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function findDefaultCompanyBusinessUnitByCompanyId(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitTransfer {
        return $this->getFactory()
            ->createZedCompaniesCompanyAddressesRestApiStub()
            ->findDefaultCompanyBusinessUnitByCompanyId($companyBusinessUnitTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompaniesCompanyAddressesDeleteResponseTransfer
     */
    public function deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
        RestCompaniesCompanyAddressesDeleteRequestTransfer $restCompaniesCompanyAddressesDeleteRequestTransfer
    ): RestCompaniesCompanyAddressesDeleteResponseTransfer {
        return $this->getFactory()
            ->createZedCompaniesCompanyAddressesRestApiStub()
            ->deleteCompanyUnitAddressByRestCompaniesCompanyAddressesDeleteRequest(
                $restCompaniesCompanyAddressesDeleteRequestTransfer,
            );
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
            ->createZedCompaniesCompanyAddressesRestApiStub()
            ->createCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $restCompaniesCompanyAddressesRequestTransfer,
            );
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
            ->createZedCompaniesCompanyAddressesRestApiStub()
            ->updateCompanyUnitAddressByRestCompaniesCompanyAddressesRequest(
                $restCompaniesCompanyAddressesRequestTransfer,
            );
    }
}
