<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update employee account');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $employee = Employee::findByUuid($this->route('employee'));

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('employees')->ignore($this->route('employee'), 'uuid')],
            'phone' => ['required', 'string', 'max:255', Rule::unique('employees')->ignore($this->route('employee'), 'uuid')],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($employee->user->uuid, 'uuid')],
        ];
    }
}
