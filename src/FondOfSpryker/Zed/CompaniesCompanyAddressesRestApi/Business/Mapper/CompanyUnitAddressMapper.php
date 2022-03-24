<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Mapper;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer;

class CompanyUnitAddressMapper implements CompanyUnitAddressMapperInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    protected $companyBusinessUnitReader;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\Reader\CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
     */
    public function __construct(
        CompanyBusinessUnitReaderInterface $companyBusinessUnitReader
    ) {
        $this->companyBusinessUnitReader = $companyBusinessUnitReader;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function fromRestCompanyUnitAddressAttributes(
        RestCompanyUnitAddressAttributesTransfer $restCompanyUnitAddressAttributesTransfer
    ): CompanyUnitAddressTransfer {
        return (new CompanyUnitAddressTransfer())->fromArray(
            $restCompanyUnitAddressAttributesTransfer->toArray(),
            true,
        )->setIso2Code($restCompanyUnitAddressAttributesTransfer->getCountry());
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function fromRestCompaniesCompanyAddressesRequest(
        RestCompaniesCompanyAddressesRequestTransfer $restCompaniesCompanyAddressesRequestTransfer
    ): CompanyUnitAddressTransfer {
        $restCompanyUnitAddressAttributesTransfer = $restCompaniesCompanyAddressesRequestTransfer
            ->getCompanyUnitAddress();

        if ($restCompanyUnitAddressAttributesTransfer === null) {
            return new CompanyUnitAddressTransfer();
        }

        $companyUnitAddressTransfer = $this->fromRestCompanyUnitAddressAttributes(
            $restCompanyUnitAddressAttributesTransfer,
        );

        $companyBusinessUnit = $this->companyBusinessUnitReader->getByRestCompaniesCompanyAddressesRequest(
            $restCompaniesCompanyAddressesRequestTransfer,
        );

        if ($companyBusinessUnit === null) {
            return $companyUnitAddressTransfer;
        }

        $companyBusinessUnitCollectionTransfer = (new CompanyBusinessUnitCollectionTransfer())
            ->addCompanyBusinessUnit($companyBusinessUnit);

        return $companyUnitAddressTransfer->setFkCompany($companyBusinessUnit->getFkCompany())
            ->setFkCompanyBusinessUnit($companyBusinessUnit->getIdCompanyBusinessUnit())
            ->setCompanyBusinessUnits($companyBusinessUnitCollectionTransfer);
    }
}
