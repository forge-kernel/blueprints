<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Modules\ForgeAuth\Contracts\UserContextInterface;
use App\Modules\ForgeRouter\Http\Attributes\Middleware;
use App\Modules\ForgeRouter\Http\Response;
use App\Modules\ForgeRouter\Attributes\Layout;
use App\Modules\ForgeRouter\Routing\Route;
use App\Modules\ForgeRouter\Traits\ResponseHelper;
use App\Modules\ForgeView\Traits\ViewHelper;
use Forge\Core\DI\Attributes\Service;

#[Service]
#[Middleware('web')]
final class LandingController
{
    use ResponseHelper;
    use ViewHelper;

    public function __construct(
        private readonly UserContextInterface $userContext,
    ) {
    }

    #[Route("/")]
    #[Layout("ForgeComponents:public")]
    public function welcome(): Response
    {
        return $this->view(view: "welcome", data: [
            'currentUser' => $this->userContext->current(),
        ]);
    }
}
