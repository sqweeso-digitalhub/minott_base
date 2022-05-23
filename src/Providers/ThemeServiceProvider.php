<?php
namespace Minott\Providers;

use IO\Extensions\Functions\Partial;
use IO\Helper\ResourceContainer;
use IO\Helper\TemplateContainer;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;

class ThemeServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;
    public function register()
    {
    }
    public function boot(Twig $twig, Dispatcher $dispatcher)
    {
        $dispatcher->listen('IO.Resources.Import', function (ResourceContainer $container) {
            $container->addStyleTemplate('Minott::Style');
        }, self::PRIORITY);

        $dispatcher->listen('IO.init.templates', function (Partial $partial) {
            $partial->set('head', 'Ceres::PageDesign.Partials.Head');
            $partial->set('header', 'Ceres::PageDesign.Partials.Header.Header');
            $partial->set('page-design', 'Ceres::PageDesign.PageDesign');
            $partial->set('footer', 'Ceres::PageDesign.Partials.Footer');

            $partial->set('head', 'Minott::PageDesign.Partials.Head');
            $partial->set('footer', 'Minott::PageDesign.Partials.Footer');
            return false;
        }, self::PRIORITY);

        $dispatcher->listen('IO.tpl.category.item', function (TemplateContainer $container) {
            $container->setTemplate('Minott::Category.Item.CategoryItem');
            return false;
        }, self::PRIORITY);
    }
}
