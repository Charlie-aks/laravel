<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên banner không được để trống',
            'name.max' => 'Tên banner không được vượt quá 255 ký tự',

            'description.string' => 'Mô tả phải là một chuỗi văn bản',

            'image.required' => 'Vui lòng chọn hình ảnh banner',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Định dạng hình ảnh không hợp lệ (jpeg, png, jpg, gif, webp)',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB',

            'status.required' => 'Trạng thái không được để trống',
            'status.in' => 'Trạng thái không hợp lệ (chỉ chấp nhận 0 hoặc 1)',
        ];
    }
}
