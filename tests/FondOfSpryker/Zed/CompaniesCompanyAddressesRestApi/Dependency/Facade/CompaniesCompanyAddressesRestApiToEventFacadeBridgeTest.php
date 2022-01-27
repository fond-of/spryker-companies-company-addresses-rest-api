<?php

namespace FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Business\EventFacadeInterface;

class CompaniesCompanyAddressesRestApiToEventFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Event\Business\EventFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyAddressesRestApi\Dependency\Facade\CompaniesCompanyAddressesRestApiToEventFacadeBridge
     */
    protected $bridge;


    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(EventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompaniesCompanyAddressesRestApiToEventFacadeBridge(
            $this->facadeMock
        );
    }

    /**
     * @return void
     */
    public function testTrigger(): void
    {
        $eventName = 'foo';

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('trigger')
            ->with($eventName, $this->transferMock);

        $this->bridge->trigger($eventName, $this->transferMock);
    }
}