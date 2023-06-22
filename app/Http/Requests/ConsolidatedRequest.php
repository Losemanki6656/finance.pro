<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ConsolidatedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ex_06' => 'integer|nullable',
            'ex_09' => 'integer|nullable',
            'ex_40' => 'integer|nullable',
            'ex_41' => 'integer|nullable',
            'ex_43' => 'integer|nullable',
            'ex_46' => 'integer|nullable',
            'ex_48' => 'integer|nullable',
            'ex_58' => 'integer|nullable',
            'ex_60' => 'integer|nullable',
            'ex_61' => 'integer|nullable',
            'ex_63' => 'integer|nullable',
            'ex_66' => 'integer|nullable',
            'ex_68' => 'integer|nullable',
            'ex_69' => 'integer|nullable',
            'ex_79' => 'integer|nullable',
            'ex_83' => 'integer|nullable',
            'send_id' => ['exists:users,id', 'required'],
            'rec_id' => ['exists:users,id', 'required']
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ex_06.integer' => 'Поле идентификатора ex_06 должно быть целым числом!',
            'ex_09.integer' => 'Поле идентификатора ex_09 должно быть целым числом!',
            'ex_40.integer' => 'Поле идентификатора ex_40 должно быть целым числом!',
            'ex_41.integer' => 'Поле идентификатора ex_41 должно быть целым числом!',
            'ex_43.integer' => 'Поле идентификатора ex_43 должно быть целым числом!',
            'ex_46.integer' => 'Поле идентификатора ex_46 должно быть целым числом!',
            'ex_48.integer' => 'Поле идентификатора ex_48 должно быть целым числом!',
            'ex_58.integer' => 'Поле идентификатора ex_58 должно быть целым числом!',
            'ex_60.integer' => 'Поле идентификатора ex_60 должно быть целым числом!',
            'ex_61.integer' => 'Поле идентификатора ex_61 должно быть целым числом!',
            'ex_63.integer' => 'Поле идентификатора ex_63 должно быть целым числом!',
            'ex_66.integer' => 'Поле идентификатора ex_66 должно быть целым числом!',
            'ex_68.integer' => 'Поле идентификатора ex_68 должно быть целым числом!',
            'ex_69.integer' => 'Поле идентификатора ex_69 должно быть целым числом!',
            'ex_79.integer' => 'Поле идентификатора ex_79 должно быть целым числом!',
            'ex_83.integer' => 'Поле идентификатора ex_83 должно быть целым числом!',
            'send_id.exists' => 'Поле идентификатора Отправитель не должно быть пустым!',
            'rec_id.exists' => 'Поле идентификатора Получатель не найдено!',
            'rec_id.required' => 'Поле идентификатора Получатель не должно быть пустым!'
        ];
    }
}