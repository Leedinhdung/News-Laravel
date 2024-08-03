<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\ForgotPassword;
use App\Models\PasswordResetToken;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function formRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        User::query()->create($data);
        return redirect()->route('login')->with('success', 'Bạn đã đăng ký thành công!');
    }
    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // Authenticate the user
        // If authenticated, redirect to dashboard
        // If not, show an error message
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Display a success toast with no title
            return redirect()->route('home');
        }
        return redirect()->route('login')->with('error', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Đăng xuất thành công');
    }

    public function forgotPassword(Request $request)
    {
        return view('auth.forgot-pass');
    }

    public function checkForgotPassword(Request $request)
    {
        // Check if user exists
        $user = User::query()->where('email', $request->email)->first();
        //        dd($user);
        if (!$user) {
            return redirect()->route('forgotPassword')->with('error', 'Email không tồn tại trong hệ thống');
        }
        // Generate a random token
        $token = Str::random(30);
        $tokenData = [
            'email' => $request->email,
            'token' => $token
        ];
        if (PasswordResetToken::create($tokenData)) {
            Mail::to($request->email)->send(new ForgotPassword($user, $token));
            return redirect()->back()->with('success', 'Mã đã gửi đến email của bạn, vui lòng kiểm tra email!');
        }
        return redirect()->back()->with('error', 'Gửi không thành công, vui lòng thử lại!');
    }

    public function formChangePassword($token)
    {
        $tokenData = PasswordResetToken::where('token', $token)->firstOrFail();

        // dd($user);
        return view('auth.reset-pass', ['token' => $token]);
    }
    public function changePassword(Request $request, $token)
    {
        $request->validate([
            'password' => ['required', 'min:8'],
            'confirmPassword' => ['required', 'same:password']
        ]);
        $tokenData = PasswordResetToken::where('token', $token)->firstOrFail();
        $user = $tokenData->user;
        $data = [
            'password' => bcrypt($request->password),
        ];
        $user->update($data);
        if ($user->update($data)) {
            return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công, vui lòng đăng nhập');
        }
    }

    public function profileUser(string $id)
    {
        $profile = User::query()->findOrFail($id);
        //        dd($profile->id);
        $listPostByUser = Post::query()->where('user_id', $profile->id)->limit(2)->get();
        //        dd($listPostByUser);
        return view('auth.profile', compact('profile', 'listPostByUser'));
    }

    public function profileSetting(string $id)
    {
        $user = User::query()->findOrFail($id);
        $role = Role::all();
        $roleOfUser = $user->roles;
        //        dd($roleOfUser);
        return view('auth.setting', compact('user', 'role', 'roleOfUser'));
    }

    public function updateProfile(Request $request, string $id)
    {
        $dataUpdate = User::query()->findOrFail($id);
        $data = $request->except('thumbnail');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::put('users', $request->file('thumbnail'));
        }
        // dd($data);
        $currentImage = $dataUpdate->thumbnail;
        $dataUpdate->update($data);
        $dataUpdate->roles()->sync($request->role_id);
        if ($request->hasFile('thumbnail') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }
        return redirect()->route('admin.auth.profile', $id)->with('message', 'Cập nhật thông tin thành công');
    }
}
