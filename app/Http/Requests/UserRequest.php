<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'      => 'required|unique:users,name',
            'email'         => 'required',
            'password'      => 'required',
            'rePassword'    => 'required|same:password',
        ];
    }
    public function messages(){
        return [
            'username.required'         => 'Vui lòng nhập Username',
            'username.unique'           => 'Username đã tồn tại',
            'email.required'            => 'Vui lòng nhập email',
            'password.required'         => 'Vui lòng nhập password',
            'rePassword.required'       => 'Vui lòng nhập lại password',
            'rePassword.same'           =>  'Sai password vui lòng kiểm tra lại',
        ];
    }
}
