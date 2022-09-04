<?php

namespace App\Http\Requests\Company;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update company accounts');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $company = Company::findByUuid($this->route('company'));

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('companies')->ignore($this->route('company'), 'uuid')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('companies')->ignore($this->route('company'), 'uuid')],
            'website' => ['nullable', 'string', 'max:255', 'url', Rule::unique('companies')->ignore($this->route('company'), 'uuid')],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($company->user_id, 'uuid')],
        ];
    }
}
