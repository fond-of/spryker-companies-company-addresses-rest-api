<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Business\CompanyUnitAddress;

use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\CompaniesCompanyAddressesRestApiEvents;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventInterface;
use FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManagerInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class CompanyUnitAddressWriter implements CompanyUnitAddressWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManagerInterface
     */
    protected $companiesCompanyAddressesRestApiEntityManager;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventInterface
     */
    protected $eventFacade;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Plugin\CompanyUnitAddressExpanderPluginInterface[]
     */
    protected $companyUnitAddressExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Persistence\CompaniesCompanyAddressesRestApiEntityManagerInterface $companiesCompanyAddressesRestApiEntityManager
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventInterface|null $eventFacade
     * @param \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Plugin\CompanyUnitAddressExpanderPluginInterface[] $companyUnitAddressExpanderPlugins
     */
    public function __construct(
        CompaniesCompanyAddressesRestApiEntityManagerInterface $companiesCompanyAddressesRestApiEntityManager,
        ?CompaniesCompanyAddressesRestApiToEventInterface $eventFacade,
        array $companyUnitAddressExpanderPlugins
    ) {
        $this->companiesCompanyAddressesRestApiEntityManager = $companiesCompanyAddressesRestApiEntityManager;
        $this->eventFacade = $eventFacade;
        $this->companyUnitAddressExpanderPlugins = $companyUnitAddressExpanderPlugins;
    }

    /**
     * @inheritDoc
     *
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function deleteCompanyUnitAddress(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer {

        return $this->getTransactionHandler()->handleTransaction(function () use ($companyUnitAddressTransfer) {

            if ($companyUnitAddressTransfer === null || $companyUnitAddressTransfer->getIdCompanyUnitAddress() === null) {
                return (new CompanyUnitAddressResponseTransfer())->setIsSuccessful(false);
            }

            $companyUnitAddressTransfer = $this->companiesCompanyAddressesRestApiEntityManager
                ->findCompanyUnitAddressByIdCompanyUnitAddress($companyUnitAddressTransfer->getIdCompanyUnitAddress());

            if ($companyUnitAddressTransfer === null) {
                return (new CompanyUnitAddressResponseTransfer())->setIsSuccessful(false);
            }

            $companyUnitAddressTransfer = $this->executeExpanderPlugins($companyUnitAddressTransfer);

            $this->companiesCompanyAddressesRestApiEntityManager
                ->deleteCompanyUnitAddressById($companyUnitAddressTransfer->getIdCompanyUnitAddress());

            $companyUnitAddressTransfer->setIsDeleted(true);

            $this->triggerEvent(
                CompaniesCompanyAddressesRestApiEvents::COMPANY_UNIT_ADDRESS_AFTER_DELETE,
                $companyUnitAddressTransfer
            );

            $companyUnitAddressResponseTransfer = (new CompanyUnitAddressResponseTransfer())
                ->setCompanyUnitAddressTransfer($companyUnitAddressTransfer)
                ->setIsSuccessful(true);

            return $companyUnitAddressResponseTransfer;
        });
    }

    /**
     * @param string $eventName
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    protected function triggerEvent(string $eventName, CompanyUnitAddressTransfer $companyUnitAddressTransfer)
    {
        if ($this->eventFacade === null) {
            return;
        }

        $this->eventFacade->trigger($eventName, $companyUnitAddressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected function executeExpanderPlugins(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressTransfer {
        foreach ($this->companyUnitAddressExpanderPlugins as $plugin) {
            $companyUnitAddressTransfer = $plugin->expand($companyUnitAddressTransfer);
        }

        return $companyUnitAddressTransfer;
    }
}
