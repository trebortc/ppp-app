<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Mail\StudentUserTemporyPasswordMail;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;


class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();

        return response()->json(['token' => $token, 'user' => new UserResource($user)], 200);
        // for httpOnly cookie
        //->withCookie(
        //                'token',
        //                auth()->getToken()->get(),
        //                config('jwt.ttl'),
        //                '/'
        //            );
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        return response()->json('Not implemented', 500);

//        $writer = Writer::create([
//            'editorial' => $request->get('editorial'),
//            'short_bio' => $request->get('short_bio'),
//        ]);
//
//        $writer->user()->create([
//            'name' => $request->get('name'),
//            'email' => $request->get('email'),
//            'password' => Hash::make($request->get('password')),]);
//
//        $user = $writer->user;
//
//        $token = JWTAuth::fromUser($writer->user);
//
//        return response()->json(new UserResource($user, $token), 201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'token_absent'], $e->getStatusCode());
        }
        return response()->json(new UserResource($user), 200);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ], 200);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesión."], 500);
        }
    }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function sendPasswordUser(Request $request){
        $request->validate([
            'email' => 'required|string|max:255',
        ]);

        try {
            $user = User::where('email', $request->get('email'))->first();    

            if($user->email_verified_at != null){
                return response()->json(['message' => 'password_already_sent'], 202);
            }

            $plain_password = Str::random(8);
            $user->password = Hash::make($plain_password);
            $user->save();


            $informacion = [
                'email' => $user->email,
                'password' => $plain_password,
            ];

            Mail::to([$user->email])
                ->send(new StudentUserTemporyPasswordMail($informacion));

            return response()->json(['message' => 'password_send'], 200);
        } catch (JWTException $e) {
            return response()->json(['message' => 'error_found'], 500);
        }
    }

    /**
     * Update user password in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function changedPasswordUser(Request $request, User $user){

        $this->authorize('update', $user);

        $request->validate([
            'currentPassword' => ['required', new MatchOldPassword()],
            'password' => ['required'],
            'confirmPassword' => ['same:password'],
        ]);

        $user->password = Hash::make($request->get('password'));
        $user->email_verified_at = now();
        $user->save();

        return response()->json(new UserResource($user), 200);
    }
}
