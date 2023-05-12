<?php
namespace App\Auth;
class Security {
    public function login(): void
    {
        echo "login";
    }

}
/* ----------------------------------------------------------*/
namespace App\Core;
class Security {
    public function checkPwd(): bool
    {
        return true;
    }

}

/* ----------------------------------------------------------*/
namespace App;
use App\Auth\Security as SecuAuth;
use App\Core\Security as SecuCore;

$secu = new SecuAuth();
$secu = new SecuAuth();
$secu = new SecuAuth();
$secu = new SecuCore();
$secu = new SecuCore();


$secu->login();