<?php

namespace FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\Dependency\Client;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface CompaniesCompanyAddressesRestApiToZedRequestClientInterface
{
    /**
     * @param string $url
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $object
     * @param array|null $requestOptions
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function call($url, TransferInterface $object, $requestOptions = null): TransferInterface;
}
