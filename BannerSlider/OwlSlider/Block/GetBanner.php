<?php
namespace BannerSlider\OwlSlider\Block;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class GetBanner extends \Magento\Framework\View\Element\Template
{
   
    protected $_getbanner;
    protected $_bannerCollection;
    protected $_storeManager;
    protected $_url;
        
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \BannerSlider\OwlSlider\Model\ResourceModel\Banner\CollectionFactory $bannerCollection,
        StoreManagerInterface $storeManager,
        UrlInterface $url,
        array $data = []
    ) {
        $this->_bannerCollection = $bannerCollection;
        $this->_storeManager = $storeManager;
        $this->_url = $url;
        parent::__construct($context, $data);
    }
    

    public function getBanners()
    {
        if (empty($this->_getbanner)) {
            $this->_getbanner = $this->_bannerCollection->create();
        }

       
        return $this->_getbanner;
    }
    
    public function mediaurl()
    {
        return $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }
}
