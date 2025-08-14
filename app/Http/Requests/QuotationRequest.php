<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'inquiry_id' => 'required|exists:inquiries,id',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'valid_days' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'days' => 'required|array|min:1',
            'days.*.title' => 'required|string',
            'days.*.description' => 'required|string',
            'days.*.location' => 'required|string',
            'days.*.accommodation' => 'nullable|string',
            'days.*.meals_included' => 'nullable|array',
            'days.*.activities' => 'nullable|array',
            'days.*.transport' => 'nullable|string',
            'days.*.cost_per_person' => 'required|numeric|min:0',
            'events' => 'nullable|array',
            'events.*.event_name' => 'required_with:events|string',
            'events.*.event_date' => 'required_with:events|date',
            'events.*.location' => 'required_with:events|string',
            'events.*.description' => 'required_with:events|string',
            'events.*.duration' => 'required_with:events|string',
            'events.*.cost_per_person' => 'required_with:events|numeric|min:0',
            'events.*.is_optional' => 'nullable|boolean',
        ];
    }
}
