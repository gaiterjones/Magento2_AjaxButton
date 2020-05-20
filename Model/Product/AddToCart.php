<?php

declare(strict_types=1);

namespace Gaiterjones\AjaxButton\Model\Product;

use Magento\Framework\Model\AbstractModel;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Data\Form\FormKey;
use Magento\Checkout\Model\Cart as Cart;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Message\ManagerInterface;

class AddToCart extends \Magento\Framework\Model\AbstractModel
{
    private $_debug;
    private $_checkoutSession;
    private $_messageManager;
    private $_formKey;
    private $_cart;
    private $_productFactory;
    private $_output;

    public function __construct(
        CheckoutSession $checkoutSession,
        ManagerInterface $messageManager,
        FormKey $formKey,
        Cart $cart,
        ProductFactory $productFactory
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_formKey = $formKey;
        $this->_cart = $cart;
        $this->_productFactory = $productFactory;
        $this->_messageManager = $messageManager;
        $this->_debug=false;
        $this->_output=new \ArrayObject();
    }


    public function addProductsToCart($productIds)
    {
        $count=0;
        $productIds=explode(",", $productIds);
        $productCollection = $this->_productFactory->create()
                             ->getCollection()
                             ->addMinimalPrice()
                             ->addFinalPrice()
                             ->addTaxPercents()
                             ->addAttributeToFilter('entity_id', array('in' => $productIds));

        $this->_output->success=false;
        $this->_output->output=false;

        foreach ($productCollection as $product) {
            $params = array(
                'form_key' => $this->_formKey->getFormKey(),
                'product_id' => $product->getId(),
                'qty' => 1
            );

            try {
                $this->_cart->addProduct($product, $params);
                $count++;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->_messageManager->addException($e, __('%1', $e->getMessage()));
                continue;
            } catch (\Exception $e) {
                $this->_messageManager->addException($e, __('error.'));
                continue;
            }
        }

        try {
            $this->_cart->save();
            $this->_messageManager->addSuccess(__('%1 products were added to the cart.', $count));
            $this->_output->success=true;
            $this->_output->output=__('%1 products were added to the cart.', $count);
        } catch (\Exception $e) {
            $this->_messageManager->addException($e, __('error.'));
            $this->_output->success=false;
            $this->_output->output=__('An error occured');
        }

        return $this->_output;
    }

    /**
     *  is product in cart
     * @param  string  $sku Product SKU
     * @return boolean  true/false
     */
    public function isProductInCart($sku)
    {
        $_cartItems = $this->_checkoutSession->getQuote()->getAllVisibleItems();
        foreach ($_cartItems as $_item) {
            // item is in cart
            if ($_item->getSku()===$sku) {
                return true;
            }
        }

        // item is not in cart
        return false;
    }
}
