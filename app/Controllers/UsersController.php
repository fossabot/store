<?php 
namespace capudev\Controllers;

use capudev\Models\User;
use Respect\Validation\Validator as validation;
use voku\helper\AntiXSS;
use Zend\Diactoros\Response\RedirectResponse;

class UsersController extends BaseController {

public function getLogin() {
return $this->renderHTML('login.twig');
}
public function postLogin($request) {
$postData = $request->getParsedBody();
$responseMessage = null;
$user = User::where('email', $postData['email'])->first();
if($user) {
if(password_verify($postData['password'], $user->password)) {
$_SESSION['userId'] = $user->id;
return new RedirectResponse('/admin');
} else {
$responseMessage = 'Bad credentials';
}
} else {
$responseMessage = 'Bad credentials';
}
return $this->renderHTML('login.twig', [
'responseMessage' => $responseMessage
]);
}


}