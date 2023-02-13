<?php
namespace BannerSlider\OwlSlider\Observer;

class DisableOutput implements \Magento\Framework\Event\ObserverInterface
{
    public const VENDOR_CONFIG = "owlSlider/general/enable";
    
    
    protected $_config;
    protected $_scopeConfig;
    protected $storeManager;
    
    
    public function __construct(
        \Magento\Config\Model\ResourceModel\Config $_config,
        \Magento\Framework\App\Config\ScopeConfigInterface $_scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->_config = $_config;
        $this->_scopeConfig = $_scopeConfig;
        $this->storeManager = $storeManager;
        $this->request = $request;
    }
    
    
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $disable = false;
        $scopeType =
            \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT;
        $scopeCode = 0;
        if ($this->request->getParam(
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        )
        ) {
            $scopeType = ScopeInterface::SCOPE_STORE;
            $scopeCode = $this->storeManager
                ->getStore(
                    $this->request->getParam(
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                    )
                )
                ->getCode();
        } elseif ($this->request->getParam(
            \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE
        )
        ) {
            $scopeType = ScopeInterface::SCOPE_WEBSITE;
            $scopeCode = $this->storeManager
                ->getWebsite(
                    $this->request->getParam(
                        \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE
                    )
                )
                ->getCode();
        } else {
            $scopeType =
                \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT;
            $scopeCode = 0;
        }
        $moduleConfig = $this->_scopeConfig->getValue(
            self::VENDOR_CONFIG,
            $scopeType
        );

        if ((int) $moduleConfig == 0) {
            $disable = true;
        }

        $moduleName = "BannerSlider_OwlSlider";
        $outputPath = "advanced/modules_disable_output/$moduleName";

        $this->_config->saveConfig(
            $outputPath,
            $disable,
            $scopeType,
            $scopeCode
        );
    }
}
