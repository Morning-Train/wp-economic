<?php

namespace Morningtrain\WpEconomic\Drivers;

use Exception;
use Morningtrain\Economic\Classes\EconomicResponse;
use Morningtrain\Economic\Interfaces\EconomicDriver;
use Morningtrain\Economic\Services\EconomicLoggerService;

class WordPressEconomicDriver implements EconomicDriver
{
    protected string $appSecretToken;

    protected string $agreementGrantToken;

    public function __construct(string $appSecretToken, string $agreementGrantToken)
    {
        $this->appSecretToken = $appSecretToken;
        $this->agreementGrantToken = $agreementGrantToken;
    }

    public function get(string $url, array $queryArgs = []): EconomicResponse
    {
        $url = add_query_arg($queryArgs, $url);

        $response = wp_remote_get($url, [
            'user-agent' => sanitize_title(get_bloginfo()),
            'headers' => $this->getHeaders(),
        ]);

        if (is_wp_error($response)) {
            EconomicLoggerService::critical($response->get_error_message(), [
                'url' => $url,
                'query_args' => $queryArgs,
            ]);

            throw new Exception($response->get_error_message());
        }

        $responseCode = wp_remote_retrieve_response_code($response);

        if (! $this->isSuccessful($responseCode)) {
            $body = json_decode(wp_remote_retrieve_body($response), true);

            if (isset($body['message'])) {
                throw new Exception($body['message']);
            }

            throw new Exception($response['response']['message']);
        }

        return new EconomicResponse($responseCode, json_decode(wp_remote_retrieve_body($response), true));
    }

    public function post(string $url, array $body = []): EconomicResponse
    {
        $response = wp_remote_post($url, [
            'user-agent' => sanitize_title(get_bloginfo()),
            'headers' => $this->getHeaders(),
            'body' => json_encode($body),
        ]);

        if (is_wp_error($response)) {
            EconomicLoggerService::critical($response->get_error_message(), [
                'url' => $url,
                'body' => $body,
            ]);

            throw new Exception($response->get_error_message());
        }

        $responseCode = wp_remote_retrieve_response_code($response);

        if (! $this->isSuccessful($responseCode)) {
            $body = json_decode(wp_remote_retrieve_body($response), true);

            if (isset($body['message'])) {
                throw new Exception($body['message']);
            }

            throw new Exception($response['response']['message']);
        }

        return new EconomicResponse(wp_remote_retrieve_response_code($response), json_decode(wp_remote_retrieve_body($response), true));

    }

    public function put(string $url, array $body = []): EconomicResponse
    {
        $response = wp_remote_request($url, [
            'user-agent' => get_bloginfo(),
            'headers' => $this->getHeaders(),
            'body' => json_encode($body),
            'method' => 'PUT',
        ]);

        if (is_wp_error($response)) {
            EconomicLoggerService::critical($response->get_error_message(), [
                'url' => $url,
                'body' => $body,
            ]);

            throw new Exception($response->get_error_message());
        }

        $responseCode = wp_remote_retrieve_response_code($response);

        if (! $this->isSuccessful($responseCode)) {
            $body = json_decode(wp_remote_retrieve_body($response), true);

            if (isset($body['message'])) {
                throw new Exception($body['message']);
            }

            throw new Exception($response['response']['message']);
        }

        return new EconomicResponse(wp_remote_retrieve_response_code($response), json_decode(wp_remote_retrieve_body($response), true));

    }

    public function delete(string $url): EconomicResponse
    {
        $response = wp_remote_request($url, [
            'user-agent' => get_bloginfo(),
            'headers' => $this->getHeaders(),
            'method' => 'DELETE',
        ]);

        if (is_wp_error($response)) {
            EconomicLoggerService::critical($response->get_error_message(), [
                'url' => $url,
            ]);

            throw new Exception($response->get_error_message());
        }

        $responseCode = wp_remote_retrieve_response_code($response);

        if (! $this->isSuccessful($responseCode)) {
            $body = json_decode(wp_remote_retrieve_body($response), true);

            if (isset($body['message'])) {
                throw new Exception($body['message']);
            }

            throw new Exception($response['response']['message']);
        }

        return new EconomicResponse(wp_remote_retrieve_response_code($response), json_decode(wp_remote_retrieve_body($response), true) ?? []);

    }

    public function patch(string $url, array $body = []): EconomicResponse
    {
        $response = wp_remote_request($url, [
            'user-agent' => get_bloginfo(),
            'headers' => $this->getHeaders(),
            'body' => json_encode($body),
            'method' => 'PATCH',
        ]);

        if (is_wp_error($response)) {
            EconomicLoggerService::critical($response->get_error_message(), [
                'url' => $url,
            ]);

            throw new Exception($response->get_error_message());
        }

        $responseCode = wp_remote_retrieve_response_code($response);

        if (! $this->isSuccessful($responseCode)) {
            throw new Exception($response['response']['message']);
        }

        return new EconomicResponse(wp_remote_retrieve_response_code($response), json_decode(wp_remote_retrieve_body($response), true) ?? []);

    }

    protected function getHeaders(): array
    {
        return [
            'X-AppSecretToken' => $this->appSecretToken,
            'X-AgreementGrantToken' => $this->agreementGrantToken,
            'Content-Type' => 'application/json',
        ];
    }

    private function isSuccessful(int|string $responseCode): bool
    {
        return $responseCode >= 200 && $responseCode < 300;
    }
}
