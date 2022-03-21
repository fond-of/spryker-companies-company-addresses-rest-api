<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CompaniesCompanyAddressesRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client\CompaniesCompanyAddressesRestApiToZedRequestClientBridge
     */
    protected $companiesCompanyAddressesRestApiToZedRequestClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferInterfaceMock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientInterfaceMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->url = 'url';

        $this->transferInterfaceMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyAddressesRestApiToZedRequestClientBridge = new CompaniesCompanyAddressesRestApiToZedRequestClientBridge(
            $this->zedRequestClientInterfaceMock,
        );
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $this->zedRequestClientInterfaceMock->expects($this->atLeastOnce())
            ->method('call')
            ->willReturn($this->transferInterfaceMock);

        $this->assertInstanceOf(
            TransferInterface::class,
            $this->companiesCompanyAddressesRestApiToZedRequestClientBridge->call(
                $this->url,
                $this->transferInterfaceMock,
            ),
        );
    }
}
