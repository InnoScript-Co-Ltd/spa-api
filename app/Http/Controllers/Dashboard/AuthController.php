<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $service
    )
    {
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
}

    /**
     * Refresh access token.
     *
     * Accept `{refreshToken: string}` from cookies.
     * @response array{data: array{accessToken: string}, status: bool}
     */
    public function refresh(Request $request): JsonResponse
    {
        $user = Auth::user();
        $request->user()->tokens()->delete();
        $tokens = $this->service->generateTokens($user);

        return $this->sendResponseWithTokens($tokens);
    }

    /**
     * @return array{
     *     accessToken: string,
     *     refreshToken: string,
     * }
     */
    public function generateTokens($user): array
    {
        $atExpireTime = now()->addMinutes(config('sanctum.expiration'));
        $rtExpireTime = now()->addMinutes(config('sanctum.rt_expiration'));

        $accessToken = $user->createToken('access_token', [TokenAbility::ACCESS_API], $atExpireTime);
        $refreshToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN], $rtExpireTime);

        return [
            'accessToken' => $accessToken->plainTextToken,
            'refreshToken' => $refreshToken->plainTextToken,
        ];
    }
}
