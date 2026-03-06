<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation() {
        $this->merge(['user_id' => auth()->id()]);
        $this->merge(['next_run_at' => $this->next_run_at]);
    }
    
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:10000',
            'next_run_at' => 'required|date',
            'frequency' => 'required|integer|min:1|max:4',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
