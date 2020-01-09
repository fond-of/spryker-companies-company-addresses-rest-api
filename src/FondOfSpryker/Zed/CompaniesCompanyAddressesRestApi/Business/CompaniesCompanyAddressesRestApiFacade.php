<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressesRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressesResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompaniesCompanyAddressesRestApiBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManagerInterface getEntityManager()
 */
class CompaniesCompanyAddressesRestApiFacade extends AbstractFacade implements CompaniesCompanyAddressesRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function findDefaultCompanyBusinessUnitByCompanyIdAction(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitTransfer {
        return $this->getFactory()
            ->createCompanyBusinessUnitReader()
            ->findDefaultCompanyBusinessUnitByCompanyId($companyBusinessUnitTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressesRequestAttributesTransfer $restCompanyUnitAddressesRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUnitAddressesResponseTransfer
     */
    public function findCompanyUnitAddressByExternalReference(
        RestCompanyUnitAddressesRequestAttributesTransfer $restCompanyUnitAddressesRequestAttributesTransfer
    ): RestCompanyUnitAddressesResponseTransfer {
        return $this->getFactory()
            ->createCompanyUnitAddressReader()
            ->findCompanyUnitAddressByExternalReference($restCompanyUnitAddressesRequestAttributesTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function deleteCompanyUnitAddress(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {

        return $this->getFactory()
            ->createCompanyUnitAddressWriter()
            ->deleteCompanyUnitAddress($companyUnitAddressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function getCompanyUnitAddressById(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressTransfer {

        return $this->getFactory()
            ->createCompanyUnitAddressReader()
            ->getCompanyUnitAddressById($companyUnitAddressTransfer);
    }
}
