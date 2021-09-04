<?php

namespace Noticebord\Client;

use GuzzleHttp\Client;
use Noticebord\Client\Models\{AuthenticateRequest, Notice, SaveNoticeRequest};

class NoticebordClient implements ClientInterface
{
    private Client $client;

    public function __construct(
        private ?string $token,
        private ?string $baseUrl = self::BASE_URL
    ) {
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'headers' => ['Accept' => 'application/json']
        ]);
    }

    /**
     * Check whether the client in authenticated.
     */
    public function isLoggedIn(): bool
    {
        return $this->token !== null;
    }

    /**
     * Get the auth token associated with this client.
     * 
     * Returns a string if the client is authenticated, and null if it is not.
     */
    public function token(): ?string
    {
        return $this->token;
    }

    /**
     * Attempts to authenticate.
     * 
     * @var $request The credentials to use to attempt authentication.
     * 
     * Returns an auth token if authentication is successful, throws an error otherwise.
     */
    public function authenticate(AuthenticateRequest $request): string
    {
        return "";
    }

    /**
     * Attempts to create a new notice.
     * 
     * @var $request The details to use to attempt creation.
     * 
     * Returns a notice if creation is successful, throws an error otherwise.
     */
    public function createNotice(SaveNoticeRequest $request): Notice
    {
        return new Notice();
    }

    /**
     * Attempts to get a single notice by its ID.
     * 
     * @var $id The id of the notice to fetch.
     * 
     * Returns a notice if fetching is successful, throws an error otherwise.
     */
    public function getNotice(int $id): Notice
    {
        return new Notice();
    }

    /** 
     * Attempts to get an array of all the notices.
     * 
     * @return Noticebord\Client\Models\Notice[]
     * 
     * Returns an array of notices if fetching is successful, throws an error otherwise.
     */
    public function getNotices(): array
    {
        return [];
    }

    /**
     * Attempts to update a notice.
     * 
     * @var $id The id of the notice to update.
     * @var $request The details to use to attempt update.
     * 
     * Returns a notice if updating is successful, throws an error otherwise.     * 
     */
    public function updateNotice(int $id, SaveNoticeRequest $request): Notice
    {
        return new Notice();
    }

    /**
     * Attempts to delete a notice.
     * 
     * @var $id The id of the notice to delete.
     * 
     * Returns a notic=e if deleting is successful, throws an error otherwise.     * 
     */
    public function deleteNotice(int $id): Notice
    {
        return new Notice();
    }
}
