<?php
namespace JoakimKejser\OAuth;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * Class TwoLeggedServer.
 */
class TwoLeggedServer extends Server
{
	/**
	 * @var OauthRequest
	 */
	public $request;

	/**
	 * @var ConsumerStoreInterface
	 */
	protected $consumerStore;

	/**
	 * @var NonceStoreInterface
	 */
	protected $nonceStore;

	public function __construct(
		OauthRequest $request,
		ConsumerStoreInterface $consumerStore,
		NonceStoreInterface $nonceStore
	) {
		$this->consumerStore = $consumerStore;
		$this->nonceStore = $nonceStore;
		$this->request = $request;
	}

	/**
	 * @param SymfonyRequest         $symfonyRequest
	 * @param ConsumerStoreInterface $consumerStore
	 * @param NonceStoreInterface    $nonceStore
	 *
	 * @return TwoLeggedServer
	 */
	public static function createFromRequest(
		SymfonyRequest $symfonyRequest,
		ConsumerStoreInterface $consumerStore,
		NonceStoreInterface $nonceStore
	) {
		$twoLeggedServer = new TwoLeggedServer(OauthRequest::createFromRequest($symfonyRequest), $consumerStore, $nonceStore);

		return $twoLeggedServer;
	}

	/**
	 * @param ConsumerStoreInterface $consumerStore
	 * @param NonceStoreInterface    $nonceStore
	 *
	 * @return TwoLeggedServer
	 */
	public static function createFromGlobals(ConsumerStoreInterface $consumerStore, NonceStoreInterface $nonceStore)
	{
		$twoLeggedServer = new TwoLeggedServer(OauthRequest::createFromGlobals(), $consumerStore, $nonceStore);

		return $twoLeggedServer;
	}
}
