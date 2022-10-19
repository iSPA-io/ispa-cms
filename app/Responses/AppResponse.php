<?php

namespace App\Responses;

use App\Constants\Constants;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class AppResponse implements Responsable
{
    /** @var string $iStatus */
    protected string $iStatus = Constants::STATUS_SUCESS;

    /** @var string|array|object|null $iData */
    protected string|array|null|object $iData = null;

    /** @var string|null $iMessage */
    protected ?string $iMessage = null;

    /** @var int $statusCode */
    protected int $statusCode = Response::HTTP_OK;

    /**
     * Set data to response
     * setData => data
     *
     * @param null $data
     * @param bool $isCamel
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:18 ICT
     */
    public function data($data = null, bool $isCamel = false): self
    {
        $this->iData = $isCamel ? collect($data)->toCamel() : $data;

        return $this;
    }

    /**
     * Set status to response
     * setStatus => status
     *
     * @param string $status
     *
     * @return AppResponse
     * @since 7.0.0 - 2022-10-20, 00:14 ICT
     * @author malayvuong
     */
    public function setStatus(string $status = Constants::STATUS_SUCESS): static
    {
        $this->iStatus = $status;

        return $this;
    }

    /**
     * Set error state
     * setError => error
     *
     * @return AppResponse
     * @author malayvuong
     * @since 7.0.0 - 2022-09-26, 23:19 ICT
     */
    public function error(): self
    {
        return $this->setStatus(Constants::STATUS_ERROR);
    }

    /**
     * Set failed state
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-10-20, 00:15 ICT
     */
    public function failed(): static
    {
        return $this->setStatus(Constants::STATUS_FAILED);
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
    public function code(int $statusCode): self
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
            'status' => $this->iStatus,
        ];
        if (! empty($this->iData)) {
            $json['data'] = $this->iData;
        }

        return response()->json($json, $this->statusCode);
    }
}
