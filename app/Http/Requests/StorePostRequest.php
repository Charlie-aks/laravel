<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép tất cả người dùng gửi request này
    }

    public function rules(): array
    {
        return [
            'topic_id'    => 'required|integer|exists:topic,id',
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255',
            'detail'      => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'type'        => 'required|string|in:post,page', // ví dụ có 2 loại
            'description' => 'nullable|string|max:500',
            'created_by'  => 'required|integer',
            'updated_by'  => 'required|integer',
            'status'      => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'topic_id.required'   => 'Vui lòng chọn chủ đề',
            'title.required'      => 'Tiêu đề không được để trống',
            'detail.required'     => 'Nội dung chi tiết là bắt buộc',
            'type.required'       => 'Vui lòng chọn loại bài viết',
            'status.required'     => 'Vui lòng chọn trạng thái',
        ];
    }
}
