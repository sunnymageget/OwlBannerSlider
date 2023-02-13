<?php

namespace BannerSlider\OwlSlider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use BannerSlider\OwlSlider\Model\ResourceModel\Banner\CollectionFactory;

class ChangeStatus extends Action
{
    
    public $collectionFactory;
    public $filter;
    
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \BannerSlider\OwlSlider\Model\BannerFactory $documentFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->documentFactory = $documentFactory;
        parent::__construct($context);
    }
    
   
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection(
                $this->collectionFactory->create()
            );

            $count = 0;
            foreach ($collection as $model) {
                $status = (int) $this->getRequest()->getParam("status");
                $bannerUpdated = 0;
                foreach ($collection as $banner) {
                    try {
                        $banner->setStatus($status)->save();

                        $bannerUpdated++;
                    } catch (Exception $e) {
                        $this->messageManager->addErrorMessage(
                            __(
                                "Something went wrong while updating status for %1.",
                                $banner->getName()
                            )
                        );
                    }
                }
                if ($bannerUpdated) {
                    $this->messageManager->addSuccessMessage(
                        __(
                            "A total of %1 record(s) have been updated.",
                            $bannerUpdated
                        )
                    );
                }
                // $model = $this->documentFactory->create()->load($model->getId());
                // $model->delete();
                // $count++;
            }
            $this->messageManager->addSuccess(
                __("A total of %1 rows have been deleted.", $count)
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory
            ->create(ResultFactory::TYPE_REDIRECT)
            ->setPath("managebanner/banner/index");
    }
}
