<?

namespace Noticebord\Client;

use Noticebord\Client\Models\{AuthenticateRequest, Notice, SaveNoticeRequest};

interface ClientInterface
{
    /**
     * @var BASE_URL Default base URL.
     * 
     * Should be used as a fallback in case a value is not explicitly provided.
     */
    public const BASE_URL = "https://noticebord.herokuapp.com/api";

    /**
     * Check whether the client in authenticated.
     */
    public function isLoggedIn(): bool;

    /**
     * Get the auth token associated with this client.
     * 
     * Returns a string if the client is authenticated, and null if it is not.
     */
    public function token(): ?string;

    /**
     * Attempts to authenticate.
     * 
     * @var $request The credentials to use to attempt authentication.
     * 
     * Returns an auth token if authentication is successful, throws an error otherwise.
     */
    public function authenticate(AuthenticateRequest $request): string;

    /**
     * Attempts to create a new notice.
     * 
     * @var $request The details to use to attempt creation.
     * 
     * Returns a notice if creation is successful, throws an error otherwise.
     */
    public function createNotice(SaveNoticeRequest $request): Notice;

    /**
     * Attempts to get a single notice by its ID.
     * 
     * @var $id The id of the notice to fetch.
     * 
     * Returns a notice if fetching is successful, throws an error otherwise.
     */
    public function getNotice(int $id): Notice;

    /** 
     * Get an array of all the notices.
     * 
     * @return Noticebord\Client\Models\Notice[]
     */
    public function getNotices(): array;

    /**
     * Attempts to update a notice.
     * 
     * @var $id The id of the notice to update.
     * @var $request The details to use to attempt update.
     * 
     * Returns a notice if updating is successful, throws an error otherwise.     * 
     */
    public function updateNotice(int $id, SaveNoticeRequest $request): Notice;

    /**
     * Attempts to delete a notice.
     * 
     * @var $id The id of the notice to delete.
     * 
     * Returns a notice if deleting is successful, throws an error otherwise.     * 
     */
    public function deleteNotice(int $id): Notice;
}
