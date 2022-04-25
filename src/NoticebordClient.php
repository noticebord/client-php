<?php

namespace Noticebord\Client;

use GuzzleHttp\{Client, RequestOptions};
use Karriere\JsonDecoder\JsonDecoder;
use Noticebord\Client\{
    Models\AuthenticateRequest,
    Models\Notice,
    Models\SaveNoticeRequest,
    Services\TokenService,
    Transformers\NoticeTransformer
};

class NoticebordClient
{
    public const DEFAULT_BASE_URL = 'http://noticebord.space';
    private Client $client;
    private JsonDecoder $decoder;

    public function __construct(
        public string $token = '',
        public string $baseUrl = self::DEFAULT_BASE_URL
    ) {
        $this->decoder = new JsonDecoder();
        $this->decoder->register(new NoticeTransformer());
    }

    /**
     * Attempts to authenticate.
     *
     * @param \Noticebord\Client\Models\AuthenticateRequest $request
     * The credentials to use to attempt authentication.
     *
     * Returns an auth token if authentication is successful, throws an error otherwise.
     */
    public function getToken(AuthenticateRequest $request): string
    {
        return TokenService::getToken($this->baseUrl, $request);
    }

    /**
     * Attempts to create a new notice.
     *
     * @param \Noticebord\Client\Models\SaveNoticeRequest $request
     * The details to use to attempt creation.
     *
     * Returns a notice if creation is successful, throws an error otherwise.
     */
    public function createNotice(SaveNoticeRequest $request): Notice
    {
        $json = $this->client
            ->post('notices', [RequestOptions::JSON => $request])
            ->getBody()
            ->getContents();

        return $this->decodeNotice($json);
    }

    /**
     * Attempts to get a single notice by its ID.
     *
     * @param int $id The id of the notice to fetch.
     *
     * Returns a notice if fetching is successful, throws an error otherwise.
     */
    public function getNotice(int $id): Notice
    {
        $json = $this->client->get("notices/$id")
            ->getBody()
            ->getContents();

        return $this->decodeNotice($json);
    }

    /**
     * Attempts to get an array of all the notices.
     *
     * @return \Noticebord\Client\Models\Notice[]
     *
     * Returns an array of notices if fetching is successful, throws an error otherwise.
     */
    public function getNotices(): array
    {
        $json = $this->client->get("notices")
            ->getBody()
            ->getContents();

        return $this->decodeNotices($json);
    }

    /**
     * Attempts to update a notice.
     *
     * @param int $id The id of the notice to update.
     * @param \Noticebord\Client\Models\SaveNoticeRequest $request The details to use to attempt update.
     *
     * Returns a notice if updating is successful, throws an error otherwise.     *
     */
    public function updateNotice(int $id, SaveNoticeRequest $request): Notice
    {
        $json = $this->client
            ->patch("notices/$id", [RequestOptions::JSON => $request])
            ->getBody()
            ->getContents();

        return $this->decodeNotice($json);
    }

    /**
     * Attempts to delete a notice.
     *
     * @param int $id The id of the notice to delete.
     *
     * Returns a notice if deletion is successful, throws an error otherwise.     *
     */
    public function deleteNotice(int $id): Notice
    {
        $json = $this->client
            ->delete("notices/$id")
            ->getBody()
            ->getContents();

        return $this->decodeNotice($json);
    }

    /**
     * Decode a notice object from JSON.
     *
     * @param string $json The JSON to decode.
     */
    private function decodeNotice(string $json): Notice
    {
        /** @var \Noticebord\Client\Models\Notice $notice */
        $notice = $this->decoder->decode($json, Notice::class);

        return $notice;
    }

    /**
     * Decode a list of notice objects from JSON.
     *
     * @param string $json The JSON to decode.
     *
     * @return \Noticebord\Client\Models\Notice[]
     */
    private function decodeNotices(string $json): array
    {
        /** @var \Noticebord\Client\Models\Notice[] $notices */
        $notices = $this->decoder->decodeMultiple($json, Notice::class);

        return $notices;
    }
}
