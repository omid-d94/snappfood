<?php

namespace App\Http\Requests\User\Comments;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use function auth;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $order = Order::where("id", $this->input("order_id"))->withTrashed()->first();
        if ($order)
            return auth()->user()->id === $order->user_id;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "message" => ["required", "string", "max:500"],
            "score" => ["required", "numeric", "between:1,5"],
            "order_id" => ["required", "unique:comments,order_id", "numeric", "exists:orders,id"]
        ];
    }


    public function messages(): array
    {
        return ["order_id.unique" => "The comment has already been registered"];
    }
}
