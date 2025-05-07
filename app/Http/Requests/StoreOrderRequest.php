<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép mọi user gửi request này
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:user,id',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
            'created_by' => 'required|integer',
            'updated_by' => 'required|integer',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User không được để trống.',
            'user_id.integer' => 'User không hợp lệ.',
            'user_id.exists' => 'User không tồn tại.',

            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.max' => 'Số điện thoại tối đa 20 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email tối đa 255 ký tự.',

            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.max' => 'Địa chỉ tối đa 255 ký tự.',

            'note.max' => 'Ghi chú không được vượt quá 1000 ký tự.',

            'created_by.required' => 'Trường người tạo là bắt buộc.',
            'updated_by.required' => 'Trường người cập nhật là bắt buộc.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
