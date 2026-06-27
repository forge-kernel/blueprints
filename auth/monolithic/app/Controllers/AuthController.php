<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Modules\ForgeAuth\Exceptions\LoginException;
use App\Modules\ForgeAuth\Services\ForgeAuthService;
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
use Forge\Core\Services\RedirectHandlerService;
use Forge\Exceptions\ValidationException;
use Forge\Traits\SecurityHelper;

#[Service]
#[Middleware('web')]
final class AuthController
{
    use ResponseHelper;
    use ViewHelper;
    use SecurityHelper;

    public function __construct(
        private readonly ForgeAuthService $forgeAuthService,
        private readonly RedirectHandlerService $redirectHandler,
    ) {
    }

    #[Route("/auth/login")]
    #[Layout("ForgeComponents:auth-split")]
    public function showLogin(): Response
    {
        return $this->view(view: "auth/login");
    }

    #[Route("/auth/login", "POST")]
    public function login(Request $request): Response
    {
        try {
            $loginCredentials = $this->sanitize($request->postData);

            $this->forgeAuthService->login($loginCredentials);
            return Redirect::to($this->redirectHandler->getRedirect('/'));
        } catch (LoginException $e) {
            Flash::set("error", "Invalid credentials. Please try again.");
            return Redirect::to('/auth/login');
        }
    }

    #[Route("/auth/register")]
    #[Layout("ForgeComponents:auth-split")]
    public function showRegister(): Response
    {
        return $this->view(view: "auth/register");
    }

    #[Route("/auth/register", "POST")]
    public function register(Request $request): Response
    {
        try {
            $registerData = $this->sanitize($request->postData);

            unset($registerData['confirm_password']);
            unset($registerData['terms']);

            $this->forgeAuthService->register($registerData);
            Flash::set("success", "Registration successful. Please login.");
            return Redirect::to('/auth/login');
        } catch (ValidationException $e) {
            Flash::set("error", $e->getMessage());
            return Redirect::to('/auth/register');
        } catch (\Exception $e) {
            Flash::set("error", $e->getMessage());
            return Redirect::to('/auth/register');
        }
    }

    #[Route('/auth/logout', 'POST')]
    public function logout(): Response
    {
        $this->forgeAuthService->logout();
        return Redirect::to('/');
    }
}
