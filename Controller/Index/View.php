<?php

namespace Gaiterjones\AjaxButton\Controller\Index;

/**
 * Class View
 *
 * @package Codextblog\Custom\Controller\Index
 */
class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->jsonFactory->create();
        $resultPage = $this->resultPageFactory->create();

        $_ajaxData=$this->getRequest()->getParam('ajaxdata');
        //file_put_contents('/var/www/dev/magento2/var/log/paj.log', print_r($_ajaxData,true), FILE_APPEND | LOCK_EX);

        if (isset($_ajaxData['action'])) {
            if ($_ajaxData['action']==='getButton') {
                $block = $resultPage->getLayout()
                    ->createBlock('Gaiterjones\AjaxButton\Block\AjaxButton')
                    ->setTemplate('Gaiterjones_AjaxButton::buttons/'. strtolower($_ajaxData['button_template']). '.phtml')
                    ->setData('ajaxdata', $_ajaxData)
                    ->toHtml();

                $result->setData(['output' => $block]);
                return  $result;
            }

            if ($_ajaxData['action']==='getData') {
                $block = $resultPage->getLayout()
                    ->createBlock('Gaiterjones\AjaxButton\Block\AjaxButton')
                    ->setTemplate('Gaiterjones_AjaxButton::actions/'. strtolower($_ajaxData['action_template']). '.phtml')
                    ->setData('ajaxdata', $_ajaxData)
                    ->toHtml();

                $result->setData(
                    array('output' => array(
                            'html' => $block,
                            'data' => false
                        ))
                );
                return  $result;
            }

            $result->setData(
                array('output' => array(
                    'html' => 'Error - Could not determine ajax button action!',
                    'data' => false
                ))
            );
        } else {
            $result->setData(
                array('output' => array(
                    'html' => 'Error - No action received from Ajax!',
                    'data' => false
                ))
            );
        }

        return  $result;
    }
}
