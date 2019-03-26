<?php
/**
 * @category   Devbera
 * @package    Devbera_AutofillCheckoutAddress
 * @author     Amit Bera <dev.amitbera@gmail.com>
 * @website    http://www.amitbera.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Devbera_AutofillCheckoutAddress',
        __DIR__
);
