<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

//use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRegisterRequest as RegisterRequest;
use App\Http\Requests\User\UserLoginRequest as LoginRequest;
use App\Http\Requests\User\UserUpdateRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\isEmpty;


class AuthenticationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\User\UserRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated["password"] = Hash::make($request->password);
        $user = User::create($validated);
        $token = $user->createToken($user->name)->plainTextToken;
        return response(
            [
                "Message" => "Registration is complete.",
                "Info:" => new UserResource($user),
                "Token" => $token,
            ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = User::where("id", $id)->first();
        if ($user?->id === auth()->user()->id) {
            return response(new UserResource($user), 200);
        }
        return response("USER NOT FOUND!", 404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\User\UserUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, int $id)
    {
        $user = User::where("id", $id)->first();

        if (auth()->user()->id !== $user?->id)
            return response("USER NOT FOUND!", 404);

        $validated = $request->validated();
        $validated["password"] = Hash::make($request->password);
        $user->update($validated);

        return response(
            ["message" => "User updated successfully"],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where("id", $id)->first();
        if (auth()->user()->id === $user?->id) {
            $user->delete();
            $user->tokens()->delete();
            return response(
                ["message" => "User deleted successfully"],
                Response::HTTP_NO_CONTENT);
        }
        return response("USER NOT FOUND!", 404);
    }

    /**
     * Login method
     *
     * @param LoginRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::where("email", $request->email)->firstOrFail();

        if (!$user || !Hash::check($validated["password"], $user->password)) {
            return \response(["message" => "These credentials do not match our records."], 401);
        }
        $token = $user->createToken($user->name)->plainTextToken;

        return response([
            "message" => "you logged in successfully",
            "token" => $token,
        ], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(["message" => "you logged out successfully"], 200);
    }
}
