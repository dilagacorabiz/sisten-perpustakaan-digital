<?php

namespace App\Http\Requests;

class UpdateBukuRequest extends StoreBukuRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        foreach ($rules as $field => $rule) {
            $rules[$field] = array_map(
                fn ($item) => $item === 'required'
                    ? 'sometimes'
                    : $item,
                explode('|', $rule)
            );
        }

        return $rules;
    }
}
