<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:category,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:0,1',
            'slug' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'parent_id' => 'nullable|integer|exists:category,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự',

            'description.string' => 'Mô tả phải là một chuỗi văn bản',

            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Định dạng hình ảnh không hợp lệ (jpeg, png, jpg, gif, webp)',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB',

            'status.required' => 'Trạng thái không được để trống',
            'status.in' => 'Trạng thái không hợp lệ',

            'slug.max' => 'Slug không được vượt quá 255 ký tự',

            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên',
            'sort_order.min' => 'Thứ tự sắp xếp không được âm',

            'parent_id.integer' => 'ID danh mục cha phải là số nguyên',
            'parent_id.exists' => 'Danh mục cha không hợp lệ',
        ];
    }
}
