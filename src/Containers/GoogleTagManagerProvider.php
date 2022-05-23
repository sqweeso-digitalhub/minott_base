<?php

namespace Minott\Containers;

use Plenty\Plugin\Templates\Twig;

class GoogleTagManagerProvider
{
    public function call(Twig $twig): string {

        $sendConfirmation = ("$_SERVER[REQUEST_URI]"=='/confirmation' || "$_SERVER[REQUEST_URI]"=='/confirmation/') ? true: false;

        return $twig->render('Minott::Containers.Components.GoogleTagManager', [
            "sendConfirmation" => $sendConfirmation
        ]);
    }
}