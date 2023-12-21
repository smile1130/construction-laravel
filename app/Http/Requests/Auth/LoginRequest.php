<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Auth, Log};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\{
    User,
};

class LoginRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function login()
    {
        $user = User::where('name', $this->name)->first();

        if (is_null($user) or !Hash::check($this->password, $user->password)) {
            session()->flash('error', 'Usuário ou senha incorretos!');
            return redirect()->back();
        }

        // #Start authentication
        Auth::login($user);
        session()->regenerate();

        session()->flash(
            'success',
            $this->name . ' fez login com sucesso.'
        );
        return redirect()->route('dashboard');
    }
}