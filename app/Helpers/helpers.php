<?php

if (! function_exists('user')) {
    /**
     * Get the authenticated user
     *
     * @param string|null $key
     * @param mixed|null $default
     *
     * @return mixed
     * @author malayvuong
     * @since 7.0.0 - 2022-10-25, 23:11 ICT
     */
    function user(string $key = null, mixed $default = null): mixed
    {
        $user = auth()->user();

        if (is_null($key)) {
            return $user;
        }

        return data_get($user, $key, $default);
    }
}
