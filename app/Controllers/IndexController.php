<?php
namespace capudev\Controllers;

use capudev\Models\User;

class IndexController extends BaseController {
public function indexAction(){
$name = 'Hector Benitez';
$limitMonths = 2000;

echo $base;

return $this->renderHTML('index.twig');
}


    
}