<?php
namespace BannerSlider\OwlSlider\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * _construct
     *
     * @return void
     */
    public function _construct()
    {
        // @codingStandardsIgnoreLine
        $this->_init('BannerSlider\OwlSlider\Model\Banner', 'BannerSlider\OwlSlider\Model\ResourceModel\Banner');
    }
}
