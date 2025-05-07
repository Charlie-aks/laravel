<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{9,15}$/',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'status' => 'required|in:0,1',
            'created_by' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên người liên hệ.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ (phải từ 9-15 chữ số).',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'content.required' => 'Vui lòng nhập nội dung liên hệ.',
            'content.min' => 'Nội dung liên hệ phải có ít nhất 10 ký tự.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
