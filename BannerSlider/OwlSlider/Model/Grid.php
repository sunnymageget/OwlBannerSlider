<?php

namespace BannerSlider\OwlSlider\Model;

use BannerSlider\OwlSlider\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
   
    protected function _construct()
    {
        $this->_init(\BannerSlider\OwlSlider\Model\ResourceModel\Banner::class);
    }
    
    
    public function getBannerId()
    {
        return $this->getData(self::ID);
    }
    
    
    public function setBannerId($bannerId)
    {
        return $this->setData(self::ID, $bannerId);
    }
    
    
    public function getName()
    {
        return $this->getData(self::NAME);
    }
    
    
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
    
    
    public function geteTitle()
    {
        return $this->getData(self::TITLE);
    }
    
    
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }
    
    
    // public function geteContent()
    // {
    //     return $this->getData(self::CONTENT);
    // }
    
    
    // public function setContent($content)
    // {
    //     return $this->setData(self::CONTENT, $content);
    // }
    
   
    public function geteImage()
    {
        return $this->getData(self::IMAGE);
    }
    
    
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    
    public function geteStatus()
    {
        return $this->getData(self::STATUS);
    }
    
   
    public function setStatus($status)
    {
        return $this->setData(self::IMAGE, $status);
    }
        
   
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
    
   
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
