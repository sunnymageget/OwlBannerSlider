<?php
namespace BannerSlider\OwlSlider\Controller\Adminhtml\Banner;

use Magento\Framework\Controller\ResultFactory;

class Addbanner extends \Magento\Backend\App\Action
{
       
    
    private $_coreRegistry;
    private $_gridFactory;
    protected $_resultRedirectFactory;
    

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \BannerSlider\OwlSlider\Model\GridFactory $gridFactory,
        \Magento\Backend\Model\View\Result\Redirect $redirect
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_gridFactory = $gridFactory;
        $this->_resultRedirectFactory = $redirect;
    }
    
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $rowId = (int) $this->getRequest()->getParam('banner_id');
        $rowData = $this->_gridFactory->create();
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowName = $rowData->getName();
            if (!$rowData->getBannerId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
               //  $this->_redirect('managebaner/banner/rowdata');
               //  return;
                return $resultRedirect->setPath('managebaner/banner/rowdata');
            }
        }
        $this->_coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Banner ').$rowName : __('Add New Banner');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
