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
final class ProfileController
{
    use ResponseHelper;
    use ViewHelper;
    use SecurityHelper;

    public function __construct(
        private readonly \App\Modules\ForgeAuth\Contracts\UserContextInterface $userContext,
    ) {
    }

    #[Route("/admin/profile")]
    #[Layout("ForgeComponents:wrappers/admin-default")]
    public function editProfile(): Response
    {
        return $this->view(view: "admin/profile", data: [
            'currentUser' => $this->userContext->current(),
        ]);
    }

    #[Route("/admin/profile", "POST")]
    public function saveProfile(Request $request): Response
    {
        $data = $this->sanitize($request->postData);

        Flash::set("success", "Profile updated successfully.");
        return Redirect::to('/admin/profile');
    }
}
