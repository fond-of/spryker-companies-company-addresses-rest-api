<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CompaniesCompanyAddressesRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompaniesCompanyAddressesRestApiToZedRequestClientBridge(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $this->zedRequestClientMock->expects($this->atLeastOnce())
            ->method('call')
            ->with('url', $this->transferMock, null)
            ->willReturn($this->transferMock);

        static::assertEquals(
            $this->transferMock,
            $this->bridge->call(
                'url',
                $this->transferMock,
                null,
            ),
        );
    }
}
