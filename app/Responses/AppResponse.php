<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class AppResponse implements Responsable
{
    /** @var bool $isError */
    protected bool $isError = false;

    /** @var int $statusCode */
    protected int $statusCode = Response::HTTP_OK;

    /** @var string|null $iMessage */
    protected ?string $iMessage = null;

    /** @var string|array|object|null $iData */
    protected string|array|null|object $iData = null;

    /**
     * Set data to response
     * setData => data
     *
     * @param null $data
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:18 ICT
     */
    public function data($data = null): self
    {
        $this->iData = $data;

        return $this;
    }

    /**
     * Set data return to camel case
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:18 ICT
     */
    public function toCamel(): self
    {
        $this->iData = collect($this->iData)->toCamel();

        return $this;
    }

    /**
     * Set error state
     * setError => error
     *
     * @param bool $state
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:19 ICT
     */
    public function error(bool $state = true): self
    {
        $this->isError = $state;

        return $this;
    }

    /**
     * Set the message
     * setMessage => message
     *
     * @param
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:20 ICT
     */
    public function message($message): self
    {
        $this->iMessage = $message;

        return $this;
    }

    /**
     * set status code
     * setStatus => status
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:22 ICT
     */
    public function status(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Return response
     *
     * @param
     *
     * @return JsonResponse|Response
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:18 ICT
     */
    public function toResponse($request): JsonResponse|Response
    {
        $json = [
            'message' => $this->iMessage,
        ];

        if ($this->isError) {
            $json['error'] = $this->iData;
        }
        if ($this->iData){
            $json['data'] = $this->iData;
        }

        return response()->json($json, $this->statusCode);
    }
}
