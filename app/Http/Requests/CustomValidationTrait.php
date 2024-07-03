<?php

namespace App\Http\Requests;

use App\Dto\Dto;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

trait CustomValidationTrait
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Dto::errorWithMessage(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                'Validation Error',
                $validator->errors()->toArray()
            )
        );
    }
}
