<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Business\EventFacadeInterface;

class CompaniesCompanyAddressesRestApiToEventBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventBridge
     */
    protected $companiesCompanyAddressesRestApiToEventBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Event\Business\EventFacadeInterface
     */
    protected $eventFacadeInterfaceMock;

    /**
     * @var string
     */
    protected $eventName;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->eventFacadeInterfaceMock = $this->getMockBuilder(EventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventName = 'event-name';

        $this->transferInterfaceMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiToEventBridge = new CompaniesCompanyAddressesRestApiToEventBridge(
            $this->eventFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testTrigger(): void
    {
        $this->companiesCompanyAddressesRestApiToEventBridge->trigger(
            $this->eventName,
            $this->transferInterfaceMock
        );
    }
}
