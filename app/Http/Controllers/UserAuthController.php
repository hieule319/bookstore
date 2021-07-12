<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\product;
use App\Models\wishlist;
use Laravel\Socialite\Facades\Socialite;

class UserAuthController extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function register()
    {
        return view('auth.register');
    }

    function create(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6|max:12'
        ]);

        $params = [
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission' => 2
        ];
        $query = User::insertOrUpdateUser($params);

        if ($query) {
            return redirect('login')->with('success', 'You have been successfuly registered');
        }else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    function check(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6|max:12'
        ]);

        $user = User::checkLogin($request);

        if ($user) {
            if (Hash::check($request->password, $user['password'])) {
                $request->session()->put('LoggedUser', $user['id']);
                return redirect('home');
            } else {
                return back()->with('fail', 'Invalid password');
            }
        } else {
            return back()->with('fail', 'No account found for this user name');
        }
    }

    function home()
    {
        if (session()->has('LoggedUser')) {
            $data['id'] = session('LoggedUser');
            $user = User::checkLogin($data);
        }
        if ($user['permission'] == 0 || $user['permission'] == 1) {
            session(['UserName' => $user['name']]);
            session(['permission' => $user['permission']]);
            session(['avatar' => $user['avatar']]);
            return view('admin.home');
        }

        if ($user['permission'] == 2) {
            $wishlists = wishlist::getListWishList($user['id']);
            $count_wishlist = count($wishlists);
            session(['wishlist' => $count_wishlist]);
            session(['UserName' => $user['name']]);
            return redirect()->to('/');
        }
    }

    function logout()
    {
        if(session()->has('LoggedUser'))
        {
            session()->flush();
            return redirect('login');
        }
    }



    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('login');
        }
        
        if(explode("@", $user->email)[1] !== 'gmail.com')
        {
            return redirect()->to('/');
        }
 
        $data['email'] = $user->email;
        $existingUser = User::checkLogin($data);
        
        if($existingUser)
        {
            session()->put('LoggedUser', $existingUser['id']);
            return redirect('home');
        }else
        {
            if($provider == "facebook")
            {
                $params = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => null,
                    'permission' => 2,
                    'provider' => $provider,
                    'provider_id' => $user->id
                ];
            }

            if($provider == "google"){
                $params = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => null,
                    'permission' => 2,
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                    'avatar_original' => $user->avatar_original
                ];
            }
            
            User::insertOrUpdateUser($params);
        }
        return redirect()->to('/');
    }

    public function profile()
    {
        $id = session('LoggedUser');
        $profile = user::getProFileById($id);
        return view('user.profile')->with(compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $params = $request->except('_token');
        if(isset($params['password']))
        {
            $params['password'] = Hash::make($params['password']);
        }
        $query = User::insertOrUpdateUser($params);

        if ($query) {
            return back()->with('success', 'Cập nhật tài khoản thành công');
        }else {
            return back()->with('fail', 'Đã xảy ra lỗi');
        }
    }

    public function addWishlist($slug)
    {
        $product = product::getProductSlug($slug);
        if(!session()->has('LoggedUser'))
        {
            return redirect('login');
        }
        $user_id = session('LoggedUser');
        $params = [
            'user_id' => $user_id,
            'product_id' => $product['id']
        ];
        $query = wishlist::insertWishlist($params);

        if ($query) {
            return back()->with('success', 'Đã thêm vào danh sách yêu thích');
        }else {
            return back()->with('fail', 'Đã xảy ra lỗi');
        }
    }

    public function removeWishlist($slug)
    {
        $product = product::getProductSlug($slug);
        $user_id = session('LoggedUser');
        $params = [
            'user_id' => $user_id,
            'product_id' => $product['id']
        ];
        $query = wishlist::removeWishlist($params);

        if ($query) {
            return back()->with('success', 'Đã xóa khỏi danh sách yêu thích');
        }else {
            return back()->with('fail', 'Đã xảy ra lỗi');
        }
    }

    public function getListWishList()
    {
        $user_id = session('LoggedUser');
        $profile = user::getProFileById($user_id);
        $wishlists = wishlist::getListWishList($user_id);
        return view('user.wishlist')->with(compact('wishlists','profile'));
    }
}
