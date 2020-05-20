<?php

declare(strict_types=1);

namespace Gaiterjones\AjaxButton\Model\Product;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Registry;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Block\Product\ListProduct;

class GetProduct extends \Magento\Framework\Model\AbstractModel
{
    private $_debug;

    protected $_product = null;
    protected $_registry;
    protected $_productRepository;
    protected $_listProductBlock;

    public function __construct(
        Registry $registry,
        ProductRepository $productRepository,
        ListProduct $listProductBlock
    ) {
        $this->_registry = $registry;
        $this->_productRepository = $productRepository;
        $this->_listProductBlock = $listProductBlock;

        $this->_debug=false;
    }

    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }

    public function getProductBySku($sku)
    {
        return $this->_productRepository->get($sku);
    }

    public function getAddToCartPostParams($product)
    {
        return $this->_listProductBlock->getAddToCartPostParams($product);
    }
}
