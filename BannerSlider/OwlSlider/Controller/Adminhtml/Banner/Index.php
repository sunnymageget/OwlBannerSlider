<?php

namespace BannerSlider\OwlSlider\Controller\Adminhtml\Banner;

class Index extends \Magento\Backend\App\Action
{
   
    protected $_resultPageFactory;
    
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }
    
   
    public function execute()
    {
        // die("sunny");

        $resultPage = $this->_resultPageFactory->create();
        $resultPage
            ->getConfig()
            ->getTitle()
            ->prepend(__("Manage Banners"));
        return $resultPage;
    }
}
