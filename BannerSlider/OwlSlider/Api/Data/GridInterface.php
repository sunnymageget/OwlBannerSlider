<?php

namespace BannerSlider\OwlSlider\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    public const ID = 'banner_id';
    public const NAME = 'name';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const IMAGE = 'image';
    public const STATUS = 'status';
    public const CREATED_AT = 'created_at';
  
    public function getEntityId();
    public function setEntityId($Id);

    public function getName();
    public function setName($name);

    public function geteTitle();
    public function setTitle($title);
   
    // public function geteContent();
    // public function setContent($phonenumber);

    public function geteImage();
    public function setImage($image);
    
    public function getCreatedAt();
    public function setCreatedAt($createdAt);
}
