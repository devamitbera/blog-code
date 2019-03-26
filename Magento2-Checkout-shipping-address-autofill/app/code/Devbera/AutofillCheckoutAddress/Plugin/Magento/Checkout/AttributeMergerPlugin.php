<?php
/**
 * @category   Devbera
 * @package    Devbera_AutofillCheckoutAddress
 * @author     Amit Bera <dev.amitbera@gmail.com>
 * @website    http://www.amitbera.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Devbera\AutofillCheckoutAddress\Plugin\Magento\Checkout;

class AttributeMergerPlugin
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function afterMerge(
        \Magento\Checkout\Block\Checkout\AttributeMerger $subject,
        $fields
    ) {
        $this->logger->info(__METHOD__);
        $shippingAddressFieldAnAutoFillValues = $this->shippingAddressFieldAnAutoFillValues();
        $fieldNames = array_keys($shippingAddressFieldAnAutoFillValues);
        $this->logger->info(print_r($fieldNames, true));

        foreach ($fields as $attributeCode => $field) {
            //$this->logger->info(print_r($field, true));
            if (in_array($attributeCode, $fieldNames)) {
                //  Different Code for set Value for Street
                if ($attributeCode == 'street' &&
                    isset($field['children'][0]['config']['customScope'])
                    && $field['children'][0]['config']['customScope'] == 'shippingAddress') {
                    $fields[$attributeCode]['children'][0]['value'] = 'Oregon State University';
                }
                // Checking Address Type Shipping and Attribute is not Street
                if ($attributeCode != 'street' &&
                    (isset($field['config']['customScope']) && ($field['config']['customScope'] == 'shippingAddress'))) {
                    // $fields[$attributeCode]['value'] = $shippingAddressFieldAnAutoFillValues[$attributeCode];
                     $this->logger->info($attributeCode);
                    switch ($attributeCode) {
                        case "firstname":
                            $fields[$attributeCode]['value'] = 'John';
                            break;
                        case "lastname":
                            $fields[$attributeCode]['value'] = 'Deo';
                            break;
                        case "city":
                            $fields[$attributeCode]['value'] = 'Corvallis';
                            break;
                        case "country_id":
                            $fields[$attributeCode]['value'] = 'US';
                            break;
                        case "region_id":
                            $fields[$attributeCode]['value'] = 49;
                            break;
                        case "telephone":
                            $fields[$attributeCode]['value'] = '+1 541-737-1000';
                            break;
                        case "company":
                            $fields[$attributeCode]['value'] = 'Public school';
                            break;
                        case "postcode":
                            $fields[$attributeCode]['value'] = '973331';
                            break;
                        case "region":
                            $fields[$attributeCode]['value'] = 'Oregon';
                            break;
                        default:
                           // echo "Your favorite color is neither red, blue, nor green!";
                    }
                }
            }
        }
        return $fields;
    }

    /**
     * Makeing an array of
     * @return array
     */
    private function shippingAddressFieldAnAutoFillValues()
    {
        return [
            'firstname' => 'John',
            'lastname' => 'Deo',
            'city' => 'Corvallis',
            'postcode' => '97331',
            'country_id' => 'US',
            'region' => 'shipping_state',
            'region_id' => 'OR',
            'telephone' => '+1 541-737-1000',
            'street' => 'Oregon State University,HP7C+G6 Corvallis',
            'company'=>'Public school'
        ];
    }
    private function prefillStreetAddress()
    {
    }
}
