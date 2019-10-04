# Company Addresses Glue Application Module
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/companies-company-addresses-rest-api)

## Installation

```
composer require fond-of-spryker/companies-company-addresses-rest-api

```

## Glue API

Add/Update Company Unit Address

##### POST {{glue_uri}}//companies/{{company_uuid}}/companies-company-addresses/

##### Example

```sh
curl -X POST "http://glue.yourdomain.com/companies/{{company_uuid}}/companies-company-addresses/" \
     -H 'Content-Type: application/json' \
     -d $'{
          "data": {
            "type": "companies-company-addresses",
                "attributes": {
                  "name1": "{{name1}}",
                  "name2": "{{name2}}",
                  "address1": "{{address1}}",
                  "address2": "{{address2}}",
                  "city": "{{city}}",
                  "zipCode": "{{zipCode}}",
                  "country": "{{countryIso2Code}}",
                  "phone": "{{phone}}",
                  "fax": "{{fax}}",
                  "comment": "{{comment}}",
                  "isDefaultBilling": {{is default billing}}
                }
              }            
          }
     }'
```

##### PATCH {{glue_uri}}//companies/{{company_uuid}}/companies-company-addresses/{{company_unit_address_uuid}}

##### Example

```sh
curl -X POST "http://glue.yourdomain.com/companies/{{company_uuid}}/companies-company-addresses/{{company_unit_address_uuid}}" \
     -H 'Content-Type: application/json' \
     -d $'{
          "data": {
            "type": "companies-company-addresses",
                "attributes": {
                  "name1": "{{name1}}",
                  "name2": "{{name2}}",
                  "address1": "{{address1}}",
                  "address2": "{{address2}}",
                  "city": "{{city}}",
                  "zipCode": "{{zipCode}}",
                  "country": "{{countryIso2Code}}",
                  "phone": "{{phone}}",
                  "fax": "{{fax}}",
                  "comment": "{{comment}}",
                  "isDefaultBilling": {{is default billing}}
                }
              }            
          }
     }'
```
