<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'content' => 'required|min:2|max:200'
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'content.required' => '内容不能为空',
            'content.min' => '内容必须至少两个字符',
            'content.max' => '内容必须至大两百个字符',
        ];
    }
}
