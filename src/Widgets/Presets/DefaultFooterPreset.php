<?php

namespace Minott\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\PresetHelper;
use IO\Extensions\Filters\PatternFilter;
use IO\Services\CategoryService;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;
use Plenty\Modules\Category\Models\Category;
use Plenty\Plugin\Translation\Translator;

class DefaultFooterPreset implements ContentPreset
{
    /** @var PresetHelper $preset */
    private $preset;

    /** @var CeresConfig $config */
    private $config;

    /** @var PatternFilter $patternFilter */
    private $patternFilter;

    /** @var CategoryService $categoryService */
    private $categoryService;

    /** @var Translator $translator */
    private $translator;

    private $gridDropzoneNames = [
        1 => "first",
        2 => "second",
        3 => "third",
        4 => "fourth"
    ];
    /**
     * Get the widget configurations of the presets to be assigned to the created content.
     *
     * @return mixed
     */
    public function getWidgets()
    {
        $this->config          = pluginApp(CeresConfig::class);
        $this->preset          = pluginApp(PresetHelper::class);
        $this->patternFilter   = pluginApp(PatternFilter::class);
        $this->categoryService = pluginApp(CategoryService::class);
        $this->translator      = pluginApp(Translator::class);

        $this->createListWidget();

        return $this->preset->toArray();
    }

    private function createListWidget()
    {
        $listGridPreset = null;

        $listGridPreset = $this->preset->createWidget("Ceres::FourColumnWidget");

        $listGridPreset
            ->createChild("first", "Minott::FooterTitleWidget")
            ->withSetting("text", 'Service Hotline');

        $listGridPreset
            ->createChild("first", "Minott::FooterTextWidget")
            ->withSetting("text", $this->getServiceText());


        $listGridPreset
            ->createChild("second", "Minott::FooterTitleWidget")
            ->withSetting("text", 'Shop Service');
        $listGridPreset
            ->createChild("second", "Minott::FooterListWidget")
            ->withSetting("entries", [
                [
                    "text" => "Item 1",
                    "url"  => [
                        "value" => "https://one-dot.de",
                        "type" => "external"
                    ]
                ],
                [
                    "text" => "Item 2",
                    "url"  => [
                        "value" => "https://one-dot.de",
                        "type" => "external"
                    ]
                ],
                [
                    "text" => "Item 3",
                    "url"  => [
                        "value" => "https://one-dot.de",
                        "type" => "external"
                    ]
                ],
            ]);


        $listGridPreset
            ->createChild("third", "Minott::FooterTitleWidget")
            ->withSetting("text", 'Information');
        $listGridPreset
            ->createChild("third", "Minott::FooterLegalInformationWidget")
            ->withSetting("showCancellationRights", true)
            ->withSetting("showLegalDisclosure", true)
            ->withSetting("showPrivacyPolicy", true)
            ->withSetting("showGtc", true)
            ->withSetting("cancellationFormContainer.showCancellationForm", true)
            ->withSetting("cancellationFormContainer.useCancellationPdfUpload", false)
            ->withSetting("cancellationFormContainer.cancellationPdfPath", "");

        $listGridPreset
            ->createChild("fourth", "Minott::FooterTitleWidget")
            ->withSetting("text", 'Newsletter');

        $listGridPreset
            ->createChild("fourth", "Ceres::NewsletterWidget")
            ->withSetting("customClass", 'dia-footer-newsletter');

        $this->preset->createWidget("Minott::ImageListWidget")
        ->withSetting("entries", []);
    }

    private function getServiceText()
    {
        $defaultText = "";
        $defaultText .= "<p class=\"column--desc\">";
        $defaultText .= "Telefonische Unterstützung und Beratung unter:";
        $defaultText .= "<br>";
        $defaultText .= "<br>";
        $defaultText .= "<a href=\"tel:+49180000000\" class=\"footer--phone-link\">";
        $defaultText .= "0180 - 000000";
        $defaultText .= "</a>";
        $defaultText .= "<br>";
        $defaultText .= "Mo-Fr, 09:00 - 17:00 Uhr";
        $defaultText .= "</p>";

        return $defaultText;
    }

}
