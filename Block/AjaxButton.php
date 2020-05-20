<?php

declare(strict_types=1);

namespace Gaiterjones\AjaxButton\Block;

use Gaiterjones\AjaxButton\Model\AjaxButton as GetAjaxButton;
use Gaiterjones\AjaxButton\Model\Product\AddToCart;
use Gaiterjones\AjaxButton\Model\Product\GetProduct;
use Gaiterjones\AjaxButton\Helper\AjaxButton as Helper;
use Magento\Framework\Registry;

/**
 * Class AjaxButton
 *
 * @package Gaiterjones\Ajaxbutton\Block\AjaxButton
 */
class AjaxButton extends \Magento\Framework\View\Element\Template
{
    protected $_ajaxButton;
    protected $_addToCart;
    protected $_getProduct;
    public $_helper;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param Magento\Catalog\Block\Product\ListProduct $listProductBlock
     * @param VWE\ProductSamples\Model\Product $getProduct
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        GetAjaxButton $ajaxButton,
        AddToCart $addToCart,
        GetProduct $getProduct,
        Helper $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_ajaxButton = $ajaxButton;
        $this->_addToCart = $addToCart;
        $this->_getProduct = $getProduct;
        $this->_helper = $helper;
    }

    public function addProductsToCart($productIds)
    {
        return $this->_addToCart->addProductsToCart($productIds);
    }

    public function getCurrentProduct()
    {
        return $this->_getProduct->getCurrentProduct();
    }

    public function getProductBySku($sku)
    {
        return $this->_getProduct->getProductBySku($sku);
    }

    public function getProductById($id)
    {
        return $this->_getProduct->getProductById($id);
    }

    public function getAddToCartPostParams($product)
    {
        return $this->_getProduct->getAddToCartPostParams($product);
    }

    /**
     * @return array
     */
    public function ajaxGetButtonData($action='getButton')
    {
        $buttonName='Default Ajax Button';
        $buttonClass='default';
        $buttonTemplate='default';
        $buttonData=array();

        if ($this->hasData("button_name")) {
            $buttonName=$this->getData("button_name");
        }
        if ($this->hasData("button_class")) {
            $buttonClass=$this->getData("button_class");
        }
        if ($this->hasData("button_template")) {
            $buttonTemplate=$this->getData("button_template");
        }
        if ($this->hasData("button_data")) {
            $buttonData=$this->getData("button_data");
        }

        $_ajaxGetButtonData=array(
            'action' => $action,
            'button_name' => $buttonName,
            'button_class' => $buttonClass,
            'button_template' => $buttonTemplate,
            'button_data' => $buttonData
        );

        return $_ajaxGetButtonData;
    }

    /**
     * @return array
     */
    public function ajaxGetActionData($action='getData')
    {
        $actionTemplate='helloworld';
        $actionData=array();

        if ($this->hasData("action_template")) {
            $actionTemplate=$this->getData("action_template");
        }
        if ($this->hasData("action_data")) {
            $actionData=$this->getData("action_data");
        }

        $_ajaxGetActionData=array(
            'action' => $action,
            'action_template' => $actionTemplate,
            'action_data' => $actionData,
        );

        return $_ajaxGetActionData;
    }

    /**
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('ajaxbutton/index/view');
    }

    /**
     * @return string
     */
    public function getAjaxWrapperClass()
    {
        $ajaxWrapperClass='default';
        if ($this->hasData("wrapper_class")) {
            $ajaxWrapperClass=$this->getData("wrapper_class");
        }
        return $ajaxWrapperClass;
    }

    /**
     * @return string
     */
    public function getAjaxButtonId()
    {
        $ajaxButtonId='1';
        if ($this->hasData("ajaxbuttonid")) {
            $ajaxButtonId=$this->getData("ajaxbuttonid");
        }
        return $ajaxButtonId;
    }

    protected function _prepareLayout()
    {
        //parent::_prepareLayout();
        $this->setTemplate('Gaiterjones_AjaxButton::ajaxbutton.phtml');
        return $this;
    }
}
