<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
        $today_date =  $today_date = date('YYYY-MM-DD');
        
        return [
            'type_id' => 'required|integer|exists:ticket_types,id',
            'module_type' => 'string|max:255',
            'details_desc' => 'required|string|max:255',
            'attachments' => 'array|min:0|max:3',
            "attachments.*" => "mimes:jpeg,jpg,png,gif",
            'priority' => 'string|max:255',
            'status' => 'string|max:255',
            'acknowledged_by' => 'integer',
            'acknowledged_at' => 'date_format:"YYYY-MM-DD hh:mm:ss"|after_or_equal'. $today_date,
            'updated_by' => 'integer|exists:users,id',
            'resolved_by' => 'integer|exists:users, id',
            'resolved_at' => 'date_format:"YYYY-MM-DD hh:mm:ss"|after_or_equal' . $today_date ,
            'assigned_to' => 'integer|exists:users,id',
            'assigned_by' => 'integer|exists:users,id',
            'deleted_by' => 'integer|exists:users,id',
            'deleted_at' => 'date_format:"YYYY-MM-DD hh:mm:ss"|after_or_equal' . $today_date
        ];
    }
}
