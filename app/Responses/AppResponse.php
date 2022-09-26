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

    /** @var string|null $message */
    protected ?string $message = null;

    /** @var null $data */
    protected $data = null;

    /**
     * Set data to response
     *
     * @param null $data
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:18 ICT
     */
    public function setData($data = null): self
    {
        $this->data = $data;

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
        $this->data = collect($this->data)->toCamel();

        return $this;
    }

    /**
     * Set error state
     *
     * @param bool $state
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:19 ICT
     */
    public function setError(bool $state = true): self
    {
        $this->isError = $state;

        return $this;
    }

    /**
     * Set the message
     *
     * @param
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:20 ICT
     */
    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * set status code
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:22 ICT
     */
    public function setStatus(int $statusCode): self
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
            'message' => $this->message,
        ];

        if ($this->isError) {
            $json['error'] = $this->data;
        }
        if ($this->data){
            $json['data'] = $this->data;
        }

        return response()->json($json, $this->statusCode);
    }
}
