<?php
/**
 * @category   Devbera
 * @package    Devbera_AutofillCheckoutAddress
 * @author     Amit Bera <dev.amitbera@gmail.com>
 * @website    http://www.amitbera.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Devbera\AutofillCheckoutAddress\Plugin\Magento\Checkout\Model;

use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Customer\Model\Context as CustomerContext;

class DefaultConfigProviderPlugin
{
    /**
     * @var HttpContext
     */
    private $httpContext;

    public function __construct(
        HttpContext $httpContext
    ) {
        $this->httpContext = $httpContext;
    }

    public function afterGetConfig(
        \Magento\Checkout\Model\DefaultConfigProvider $subject,
        $result
    ) {
        if (!$this->isCustomerLoggedIn() && is_array($result)) {
            $result['validatedEmailValue'] = 'john.deo@gmail.com';
        }
        return $result;
    }
    /**
     * Check if customer is logged in
     *
     * @return bool
     * @codeCoverageIgnore
     */
    private function isCustomerLoggedIn()
    {
        return (bool)$this->httpContext->getValue(CustomerContext::CONTEXT_AUTH);
    }
}
