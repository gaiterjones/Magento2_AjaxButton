<?php

declare(strict_types=1);

namespace Gaiterjones\AjaxButton\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class AjaxButton extends AbstractHelper
{
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    public function getButton($_ajax): string
    {
        $_buttonClass='default';
        $_buttonName='Ajax Button!';

        if ($_ajax) {
            if (isset($_ajax['ajaxdata']['button_name'])) {
                $_buttonName=$_ajax['ajaxdata']['button_name'];
            }
            if (isset($_ajax['ajaxdata']['button_class'])) {
                $_buttonClass=$_ajax['ajaxdata']['button_class'];
            }
        }

        $_button='<button class="gj-ajaxbutton '. $_buttonClass. '" type="button"><span>'. $_buttonName. '</span></button>';
        return $_button;
    }
}
