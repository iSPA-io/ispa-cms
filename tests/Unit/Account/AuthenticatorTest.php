<?php

namespace Tests\Unit\Account;

use JsonException;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatorTest extends TestCase
{
    //  A unit test that call the sign api with the wrong params
    public function test_sign_in_with_wrong_params_return_error_validation_messages(): void
    {
        $params = [
            'username' => 123,
            'password' => null
        ];

        $response = $this->post('/api/v1/admin/auth/sign-in', $params);

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    /**
     * @throws JsonException
     */
    public function test_sign_in_successfully(): void
    {
        $params = [
            'username' => 'malayvuong',
            'password' => 'ispa.io'
        ];

        $response = $this->post('/api/v1/admin/auth/sign-in', $params);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertArrayHasKey('account', $data['data']);
        $this->assertArrayHasKey('token', $data['data']);
    }

    //  A unit test that sign in with wrong password
    public function test_sign_in_with_wrong_password_return_error_message(): void
    {
        $params = [
            'username' => 'malayvuong',
            'password' => 'ispa'
        ];

        $response = $this->post('/api/v1/admin/auth/sign-in', $params);

        $this->assertEquals(Response::HTTP_NOT_ACCEPTABLE, $response->getStatusCode());

        $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertEquals(__('auth.failed'), $data['message']);
    }
}
