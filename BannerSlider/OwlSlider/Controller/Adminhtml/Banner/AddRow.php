<?php
namespace BannerSlider\OwlSlider\Controller\Adminhtml\Banner;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
        
    
    private $coreRegistry;
    private $gridFactory;
    protected $_resultRedirectFactory;
        
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \BannerSlider\OwlSlider\Model\BannerFactory $gridFactory,
        \Magento\Backend\Model\View\Result\Redirect $redirect
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
        $this->_resultRedirectFactory = $redirect;
    }
        
   
    public function execute()
    {
         $resultRedirect = $this->resultRedirectFactory->create();
         $rowId = (int) $this->getRequest()->getParam('banner_id');
         $rowData = $this->gridFactory->create();
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowName = $rowData->getName();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
            //    $this->_redirect('enquire/grid/rowdata');
            //    return;
                return $resultRedirect->setPath('enquire/grid/rowdataa');
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ').$rowName : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
