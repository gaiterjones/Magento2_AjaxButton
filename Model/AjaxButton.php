<?php

namespace Gaiterjones\AjaxButton\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\Http\Context as HttpContext;

class AjaxButton extends \Magento\Framework\Model\AbstractModel
{
    private $httpContext;


    public function __construct(
        HttpContext $httpContext
    ) {
        $this->httpContext = $httpContext;
    }

    /**
     * is logged in using CONTEXT_AUTH
     * @return boolean
     */
    public function isLoggedIn()
    {
        //
        // https://magento.stackexchange.com/a/171126/7863
        //
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $isLoggedIn;
    }
}
