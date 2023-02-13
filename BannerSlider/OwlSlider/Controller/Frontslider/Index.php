<?php

namespace BannerSlider\OwlSlider\Controller\Frontslider;


class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_forwardFactory;
	protected $_moduleManager;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Framework\Controller\Result\ForwardFactory $forwardFactory,
		\Magento\Framework\Module\Manager $moduleManager

		
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_forwardFactory = $forwardFactory;
		$this->_moduleManager = $moduleManager;
	
		return parent::__construct($context);
	}

	public function execute()
	{
            
		// die("sunny");

	
			return $this->_pageFactory->create();
   
		
	}

} 


