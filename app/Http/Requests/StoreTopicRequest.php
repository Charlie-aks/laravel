<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép tất cả request (có thể giới hạn theo quyền nếu cần)
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:1000',
            'slug'        => 'required|string|max:1000|unique:topic,slug',
            'description' => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'created_by'  => 'required|integer',
            'updated_by'  => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Vui lòng nhập tên chủ đề.',
            'slug.required'  => 'Vui lòng nhập slug.',
            'slug.unique'    => 'Slug đã tồn tại.',
            'status.required'=> 'Vui lòng chọn trạng thái.',
        ];
    }
}
