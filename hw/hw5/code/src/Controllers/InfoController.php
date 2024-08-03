<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Models\SiteInfo;
use Geekbrains\Application1\Render;

class InfoController
{
    function actionIndex(): string
    {
        $info = new SiteInfo();
        $render = new Render();
        return $render->renderPage('site-info.twig', [
            "server" => $info->getWebServer(),
            "phpVersion" => $info->getPhpVersion(),
            "userAgent" => $info->getUserAgent(),
            "title" => 'Информация'
        ]);
    }
}