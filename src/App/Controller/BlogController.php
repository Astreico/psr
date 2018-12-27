<?php
/**
 * Created by PhpStorm.
 * User: olas
 * Date: 15.10.18
 * Time: 21.46
 */

namespace App\Controller;


use Zend\Diactoros\Response\HtmlResponse;

class BlogController
{
    public function __invoke($request)
    {
        return new HtmlResponse('Blog action');
    }
}
