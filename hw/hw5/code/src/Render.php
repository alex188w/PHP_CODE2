<?php

namespace Geekbrains\Application1;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Render {

    private string $viewFolder = '/src/Views/';
    private FilesystemLoader $loader;
    private Environment $environment;


    public function __construct(){

        $this->loader = new FilesystemLoader(dirname(__DIR__) . $this->viewFolder);
        $this->environment = new Environment($this->loader, [
           // 'cache' => $_SERVER['DOCUMENT_ROOT'].'/cache/',
        ]);
    }

    public function renderPage(string $contentTemplateName = 'page-index.twig', array $templateVariables = []) {
        $template = $this->environment->load('main.twig');
        
        $templateVariables['header'] = 'header.twig';
        $templateVariables['nav'] = 'navigation.twig';
        $templateVariables['footer'] = 'footer.twig';
        $templateVariables['content_template_name'] = $contentTemplateName;
 
        return $template->render($templateVariables);
    }
}