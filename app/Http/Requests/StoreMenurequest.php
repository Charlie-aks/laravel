<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép mọi user gửi request, bạn có thể chỉnh lại nếu cần phân quyền
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'link'        => 'required|string|max:255',
            'type'        => 'required|string|in:category,brand,page,topic,custom',
            'position'    => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'sort_order'  => 'nullable|integer|min:0',
            'parent_id'   => 'nullable|integer|min:0',
            'created_by'  => 'nullable|integer|min:1',
            'updated_by'  => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Vui lòng nhập tên menu.',
            'link.required'       => 'Vui lòng nhập liên kết.',
            'type.required'       => 'Vui lòng chọn loại menu.',
            'type.in'             => 'Loại menu không hợp lệ.',
            'status.required'     => 'Vui lòng chọn trạng thái.',
            'status.boolean'      => 'Trạng thái phải là true hoặc false.',
            'sort_order.integer'  => 'Thứ tự phải là số.',
            'parent_id.integer'   => 'Menu cha phải là số.',
        ];
    }
}
