<?php

namespace FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiClient;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Deleter\CompanyUnitAddressDeleter;
use FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\Processor\Writer\CompanyUnitAddressWriter;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class CompaniesCompanyAddressesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyAddressesRestApi\CompaniesCompanyAddressesRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(CompaniesCompanyAddressesRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class (
            $this->clientMock,
            $this->restResourceBuilderMock
        ) extends CompaniesCompanyAddressesRestApiFactory {
            /**
             * @var \Spryker\Client\Kernel\AbstractClient
             */
            protected $abstractClient;

            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @param \Spryker\Client\Kernel\AbstractClient $abstractClient
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             */
            public function __construct(
                AbstractClient $abstractClient,
                RestResourceBuilderInterface $restResourceBuilder
            ) {
                $this->restResourceBuilder = $restResourceBuilder;
                $this->abstractClient = $abstractClient;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }

            /**
             * @return \Spryker\Client\Kernel\AbstractClient
             */
            protected function getClient(): AbstractClient
            {
                return $this->abstractClient;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressDeleter(): void
    {
        static::assertInstanceOf(
            CompanyUnitAddressDeleter::class,
            $this->factory->createCompanyUnitAddressDeleter(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyUnitAddressWriter(): void
    {
        static::assertInstanceOf(
            CompanyUnitAddressWriter::class,
            $this->factory->createCompanyUnitAddressWriter(),
        );
    }
}
