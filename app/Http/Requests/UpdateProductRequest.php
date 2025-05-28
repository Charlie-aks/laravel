<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'detail' => 'required|string',
            'price_root' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'category_id' => 'required|exists:category,id',
            'brand_id' => 'required|exists:brand,id',
            'status' => 'required|in:0,1',
            'thumbnail.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            'detail.required' => 'Vui lòng nhập chi tiết sản phẩm',
            'price_root.required' => 'Vui lòng nhập giá gốc',
            'price_root.numeric' => 'Giá gốc phải là số',
            'price_root.min' => 'Giá gốc không được nhỏ hơn 0',
            'price_sale.numeric' => 'Giá khuyến mãi phải là số',
            'price_sale.min' => 'Giá khuyến mãi không được nhỏ hơn 0',
            'qty.required' => 'Vui lòng nhập số lượng',
            'qty.integer' => 'Số lượng phải là số nguyên',
            'qty.min' => 'Số lượng không được nhỏ hơn 0',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'category_id.exists' => 'Danh mục không tồn tại',
            'brand_id.required' => 'Vui lòng chọn thương hiệu',
            'brand_id.exists' => 'Thương hiệu không tồn tại',
            'thumbnail.*.image' => 'File phải là hình ảnh',
            'thumbnail.*.mimes' => 'Định dạng file không hợp lệ (chỉ chấp nhận jpeg,png,jpg,gif,webp)',
            'thumbnail.*.max' => 'Kích thước file không được vượt quá 2MB',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];
    }
} 