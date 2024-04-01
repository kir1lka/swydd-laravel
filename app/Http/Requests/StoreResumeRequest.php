<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:55', 'min:5'],
            'surname' => ['required', 'string', 'max:55', 'min:5'],
            'last_name' => ['required', 'string', 'max:55', 'min:5'],
            'city' => ['required', 'string', 'min:5'],
            'date_of_birtday' => ['required', 'date_format:d-m-Y'],
            'phone' => ['required', 'min:5', 'max:55'],
            'title' => ['required', 'min:5', 'max:55'],
            'nationality' => ['required', 'min:5', 'max:55'],
            'experience' => ['required', 'min:5', 'max:55'],
            'education' => ['required', 'min:5', 'max:55'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'last_name' => 'Отчество',
            'city' => 'Город',
            'date_of_birtday' => 'Год рождения',
            'phone' => 'Телефон',
            'title' => 'Желаемая должность',
            'nationality' => 'Национальность',
            'experience' => 'Опыт работы',
            'education' => 'Образование',
        ];
    }
}
