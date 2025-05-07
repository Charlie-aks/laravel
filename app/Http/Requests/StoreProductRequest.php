<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'status' => 'required|in:0,1',
    ];
}

public function messages(): array
{
    return [
        'name.required' => 'Tên sản phẩm không được để trống',
        'name.unique' => 'Tên sản phẩm đã tồn tại',
        'thumbnail.required' => 'Vui lòng chọn hình ảnh',
        'thumbnail.image' => 'File phải là hình ảnh',
        'thumbnail.mimes' => 'Định dạng file không hợp lệ (chỉ chấp nhận jpeg,png,jpg,gif,webp)',
        'thumbnail.max' => 'Kích thước file không được vượt quá 2MB',
        'detail.required' => 'Chi tiết sản phẩm không được để trống',
        'category_id.required' => 'Vui lòng chọn danh mục',
        'category_id.exists' => 'Danh mục không hợp lệ',
        'brand_id.required' => 'Vui lòng chọn thương hiệu',
        'brand_id.exists' => 'Thương hiệu không hợp lệ',
        'price_root.required' => 'Giá bán không được để trống',
        'price_root.numeric' => 'Giá bán phải là số',
        'price_root.min' => 'Giá bán không được âm',
        'price_sale.required' => 'Giá khuyến mãi không được để trống',
        'price_sale.numeric' => 'Giá khuyến mãi phải là số',
        'price_sale.min' => 'Giá khuyến mãi không được âm',
        'qty.required' => 'Số lượng không được để trống',
        'qty.integer' => 'Số lượng phải là số nguyên',
        'qty.min' => 'Số lượng tối thiểu là 1'
    ];
}
}
