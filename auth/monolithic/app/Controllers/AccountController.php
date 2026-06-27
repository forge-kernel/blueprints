<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Modules\ForgeRouter\Helpers\Redirect;
use App\Modules\ForgeRouter\Http\Attributes\Middleware;
use App\Modules\ForgeRouter\Http\Request;
use App\Modules\ForgeRouter\Http\Response;
use App\Modules\ForgeRouter\Attributes\Layout;
use App\Modules\ForgeRouter\Routing\Route;
use App\Modules\ForgeRouter\Traits\ResponseHelper;
use App\Modules\ForgeView\Traits\ViewHelper;
use Forge\Core\DI\Attributes\Service;
use Forge\Core\Helpers\Flash;
use Forge\Traits\SecurityHelper;

#[Service]
#[Middleware('web')]
#[Middleware('auth')]
final class AccountController
{
    use ResponseHelper;
    use ViewHelper;
    use SecurityHelper;

    public function __construct(
        private readonly \App\Modules\ForgeAuth\Contracts\UserContextInterface $userContext,
    ) {
    }

    #[Route("/admin/account")]
    #[Layout("ForgeComponents:wrappers/admin-default")]
    public function editAccount(): Response
    {
        return $this->view(view: "admin/account", data: [
            'currentUser' => $this->userContext->current(),
        ]);
    }

    #[Route("/admin/account", "POST")]
    public function saveAccount(Request $request): Response
    {
        $data = $this->sanitize($request->postData);

        Flash::set("success", "Account settings saved successfully.");
        return Redirect::to('/admin/account');
    }
}
