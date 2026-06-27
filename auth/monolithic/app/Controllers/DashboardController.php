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
#[Middleware('auth')]
final class DashboardController
{
    use ResponseHelper;
    use ViewHelper;

    public function __construct(
        private readonly UserContextInterface $userContext,
    ) {
    }

    #[Route("/admin")]
    #[Layout("ForgeComponents:wrappers/admin-default")]
    public function dashboard(): Response
    {
        $currentUser = $this->userContext->current();

        $stats = [
            ['label' => 'Total Users', 'value' => '—'],
            ['label' => 'Active Sessions', 'value' => '1'],
            ['label' => 'Modules', 'value' => '—'],
            ['label' => 'Kernel', 'value' => '—'],
        ];

        $activities = [
            ['description' => 'Welcome to the admin console', 'time' => 'Just now'],
        ];

        $quickActions = [
            ['label' => 'View Users', 'href' => '/admin/users'],
            ['label' => 'Account Settings', 'href' => '/admin/account'],
            ['label' => 'Edit Profile', 'href' => '/admin/profile'],
        ];

        return $this->view(view: "admin/dashboard", data: [
            'stats' => $stats,
            'activities' => $activities,
            'quickActions' => $quickActions,
            'currentUser' => $currentUser,
        ]);
    }
}
