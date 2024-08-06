<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Domain\Models\SiteInfo;
use Geekbrains\Application1\Application\Render;

class InfoController
{
    function actionIndex(): string
    {
        $info = new SiteInfo();
        $render = new Render();
        return $render->renderPage('pages/site-info.twig', [
            "server" => $info->getWebServer(),
            "phpVersion" => $info->getPhpVersion(),
            "userAgent" => $info->getUserAgent(),
            "title" => 'Информация'
        ]);
    }
}