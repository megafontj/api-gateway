<?php

namespace App\Services;

use Closure;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;

abstract class ApiProxy
{
    protected string $acceptMedia = 'application/json';
    protected string $contentType = 'application/json';

    protected Client $client;

    public function __construct(string $base_uri)
    {
        $this->client = new Client([
            'base_uri' => $base_uri,
            'headers' => [
                'Accept' => $this->acceptMedia,
                'Content-Type' => $this->contentType,
            ]
        ]);
    }

    protected function postJson(string $path, array $data = []): ApiResponse
    {
        $response = $this->tryRequest(fn() => $this->client->post($path, ['json' => $data]));

        return new ApiResponse($response);
    }

    protected function patchJson(string $path, array $data = []): ApiResponse
    {
        $response = $this->tryRequest(fn() => $this->client->patch($path, ['json' => $data]));

        return new ApiResponse($response);
    }

    protected function getJson($path, $queryParams = null): ApiResponse
    {
        $response = $this->tryRequest(fn() => $this->client->get($path, [
            'query' => $queryParams
        ]));

        return new ApiResponse($response);
    }

    protected function getWithToken(string $path, string $token, array $options = []): ApiResponse
    {
        $response = $this->tryRequest(fn() => $this->client->get($path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ]));

        return new ApiResponse($response);
    }
    /**
     * Этот метод конвертирут guzzleHttp Exceptions на ларавлеские Exceptions
     * Почему конвертировать? Потому что подерживать один и тотже Exceptions ответов(responses)
     * Может быть в сервисе Users какие та поля не проходят валидатцию и GuzzelException возвращает его вообеще по другому
     * а тут конвертируем его что бы на фронтеде безапасно и лего показат ошибки
     */
    protected function tryRequest(Closure $callback): ResponseInterface
    {
        try {
            return $callback();
        } catch (ClientException $clientException) {
            $responseContents = json_decode($clientException->getResponse()->getBody()->getContents(), true);
            if ($clientException->getCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
                throw ValidationException::withMessages($responseContents['errors']);
            }
            throw new Exception($responseContents['message'], $clientException->getCode());
        } catch (ServerException $serverException) {
            $responseContents = json_decode($serverException->getResponse()->getBody()->getContents(), true);
            throw new Exception($responseContents['message'], $serverException->getCode());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

}
