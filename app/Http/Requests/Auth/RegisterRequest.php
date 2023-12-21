<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Auth};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\{
    User,
};

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>
                'required|unique:users,name|alpha_num|min:4|max:20',
            'password' => 'required|min:8|max:80|confirmed',
            'phonenum' => 'required',
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function register()
    {
        $user = new User();
        $user->name = $this->name;
        $user->password = Hash::make($this->password);
        $user->phonenum = $this->phonenum;

        $user->save();

        #Start authentication
        Auth::login($user);
        session()->regenerate();
        
        session()->flash(
            'success',
            $this->name . ' se registrou com sucesso.'
        );
        return redirect()->route('dashboard');
    }
}