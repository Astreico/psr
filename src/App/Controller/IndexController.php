<?php
/**
 * Created by PhpStorm.
 * User: olas
 * Date: 15.10.18
 * Time: 21.46
 */

namespace App\Controller;


use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class IndexController
{
    protected $render;

    public function __construct($twig)
    {
        $this->render = $twig;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $user = $request->getAttribute('user');
        $html = $this->render->render('layout/layout.html.twig');
        return new HtmlResponse($html);
    }
}
