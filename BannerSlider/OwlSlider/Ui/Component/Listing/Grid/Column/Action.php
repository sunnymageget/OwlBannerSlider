<?php

namespace BannerSlider\OwlSlider\Ui\Component\Listing\Grid\Column;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;


class Action extends Column
{
    /** Url path */
    public const CMS_URL_PATH_EDIT = "managebanner/banner/addbanner";
    public const CMS_URL_PATH_DELETE = "managebanner/banner/delete";

  
    protected $urlBuilder;
    private $editUrl;
    private $escaper;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::CMS_URL_PATH_EDIT
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

   
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as &$item) {
                $name = $this->getData("name");
                if (isset($item["banner_id"])) {
                    $item[$name]["edit"] = [
                        "href" => $this->urlBuilder->getUrl($this->editUrl, [
                            "banner_id" => $item["banner_id"],
                        ]),
                        "label" => __("Edit"),
                    ];
                    $title = $this->getEscaper()->escapeHtml($item["name"]);
                    $item[$name]["delete"] = [
                        "href" => $this->urlBuilder->getUrl(
                            self::CMS_URL_PATH_DELETE,
                            ["banner_id" => $item["banner_id"]]
                        ),
                        "label" => __("Delete"),
                        "confirm" => [
                            "title" => __("Delete %1", $title),
                            "message" => __(
                                "Are you sure you want to delete a %1 record?",
                                $title
                            ),
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }


    private function getEscaper()
    {
        if (!$this->escaper) {
            $this->escaper = ObjectManager::getInstance()->get(Escaper::class);
        }
        return $this->escaper;
    }
}
