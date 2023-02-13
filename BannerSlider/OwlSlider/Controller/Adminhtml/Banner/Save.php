<?php
namespace BannerSlider\OwlSlider\Controller\Adminhtml\Banner;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

class Save extends \Magento\Backend\App\Action
{
    // var $bannerFactory;

    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    protected $_resultRedirectFactory;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \BannerSlider\OwlSlider\Model\BannerFactory $bannerFactory,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        \Magento\Backend\Model\View\Result\Redirect $redirect
    ) {
        parent::__construct($context);
        $this->bannerFactory = $bannerFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->_resultRedirectFactory = $redirect;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(
            \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
        );
    }
    
   
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            // $this->_redirect("managebanner/banner/banner");
            // return;
            return $resultRedirect->setPath('managebanner/banner/banner');
        }
        try {
            $rowData = $this->bannerFactory->create();

            $files = $this->getRequest()->getFiles("file");
            $target = $this->_mediaDirectory->getAbsolutePath(
                "BannerSlider_OwlSlider/"
            );
            //attachment is the input file name posted from your form
            $uploader = $this->uploaderFactory->create(["fileId" => "image"]);
            $_fileType = $uploader->getFileExtension();
            $uniqid = uniqid();
            $newFileName = $uniqid . "." . $_fileType;
            $uploader->setAllowedExtensions(["jpg", "jpeg", "png"]);

            $uploader->setAllowRenameFiles(true);

            $result = $uploader->save($target, $newFileName);

            $data["image"] = $newFileName;

            $rowData->setData($data);

            if (isset($data["banner_id"])) {
                $rowData->setEntityId($data["banner_id"]);
            }

            $rowData->save();
            $this->messageManager->addSuccess(
                __("Banner has been successfully Added.")
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $resultRedirect->setPath('managebanner/banner');
    }
}
