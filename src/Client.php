<?php

declare(strict_types=1);

namespace YourBureau\Api;

use YourBureau\Api\Exception\ApiException;
use YourBureau\Api\Exception\AuthenticationException;
use YourBureau\Api\Exception\NotFoundException;
use YourBureau\Api\Exception\RateLimitException;
use YourBureau\Api\Exception\TransportException;
use YourBureau\Api\Exception\ValidationException;
use YourBureau\Api\Http\CurlTransport;
use YourBureau\Api\Http\Response;
use YourBureau\Api\Http\TransportInterface;
use YourBureau\Api\Resource\AbsenceTypes;
use YourBureau\Api\Resource\ArticleCategories;
use YourBureau\Api\Resource\ArticleTaxes;
use YourBureau\Api\Resource\ArticleUnits;
use YourBureau\Api\Resource\Articles;
use YourBureau\Api\Resource\Assistant;
use YourBureau\Api\Resource\BankAccounts;
use YourBureau\Api\Resource\Cantons;
use YourBureau\Api\Resource\Comments;
use YourBureau\Api\Resource\Contacts;
use YourBureau\Api\Resource\Countries;
use YourBureau\Api\Resource\Currencies;
use YourBureau\Api\Resource\CustomerContacts;
use YourBureau\Api\Resource\CustomerStates;
use YourBureau\Api\Resource\Customers;
use YourBureau\Api\Resource\Departments;
use YourBureau\Api\Resource\Distributors;
use YourBureau\Api\Resource\EmailTemplates;
use YourBureau\Api\Resource\Encashments;
use YourBureau\Api\Resource\Events;
use YourBureau\Api\Resource\Expenses;
use YourBureau\Api\Resource\InvoiceStates;
use YourBureau\Api\Resource\Invoices;
use YourBureau\Api\Resource\Languages;
use YourBureau\Api\Resource\MyTimeReports;
use YourBureau\Api\Resource\MyUser;
use YourBureau\Api\Resource\OfferStates;
use YourBureau\Api\Resource\Offers;
use YourBureau\Api\Resource\OpenTaskCategories;
use YourBureau\Api\Resource\OpenTaskStates;
use YourBureau\Api\Resource\OpenTasks;
use YourBureau\Api\Resource\OrderCategories;
use YourBureau\Api\Resource\OrderSchedulingCategories;
use YourBureau\Api\Resource\OrderStates;
use YourBureau\Api\Resource\Orders;
use YourBureau\Api\Resource\OutgoingStates;
use YourBureau\Api\Resource\OutgoingTaxes;
use YourBureau\Api\Resource\Outgoings;
use YourBureau\Api\Resource\Places;
use YourBureau\Api\Resource\ProjectStates;
use YourBureau\Api\Resource\Projects;
use YourBureau\Api\Resource\PublicHolidays;
use YourBureau\Api\Resource\Salutations;
use YourBureau\Api\Resource\Settings;
use YourBureau\Api\Resource\SupportTickets;
use YourBureau\Api\Resource\TimeReportExpenses;
use YourBureau\Api\Resource\TimeReports;
use YourBureau\Api\Resource\UserAbsences;
use YourBureau\Api\Resource\UserLocation;
use YourBureau\Api\Resource\Users;
use YourBureau\Api\Resource\WorkPackages;

/**
 * Entry point for the yourBureau REST API v3.
 */
final class Client
{


	private readonly TransportInterface $transport;

	private ?Customers $customers = null;

	private ?Contacts $contacts = null;

	private ?CustomerContacts $customerContacts = null;

	private ?Projects $projects = null;

	private ?Outgoings $outgoings = null;

	private ?Distributors $distributors = null;

	private ?Articles $articles = null;

	private ?Users $users = null;

	private ?TimeReports $timeReports = null;

	private ?TimeReportExpenses $timeReportExpenses = null;

	private ?OpenTasks $openTasks = null;

	private ?SupportTickets $supportTickets = null;

	private ?Offers $offers = null;

	private ?Orders $orders = null;

	private ?Invoices $invoices = null;

	private ?Events $events = null;

	private ?WorkPackages $workPackages = null;

	private ?Settings $settings = null;

	private ?UserAbsences $userAbsences = null;

	private ?MyTimeReports $myTimeReports = null;

	private ?MyUser $myUser = null;

	private ?Comments $comments = null;

	private ?UserLocation $userLocation = null;

	private ?Assistant $assistant = null;

	private ?Salutations $salutations = null;

	private ?Countries $countries = null;

	private ?Cantons $cantons = null;

	private ?Currencies $currencies = null;

	private ?Departments $departments = null;

	private ?Places $places = null;

	private ?Encashments $encashments = null;

	private ?Languages $languages = null;

	private ?AbsenceTypes $absenceTypes = null;

	private ?ArticleCategories $articleCategories = null;

	private ?ArticleTaxes $articleTaxes = null;

	private ?ArticleUnits $articleUnits = null;

	private ?BankAccounts $bankAccounts = null;

	private ?EmailTemplates $emailTemplates = null;

	private ?OfferStates $offerStates = null;

	private ?OrderCategories $orderCategories = null;

	private ?OrderSchedulingCategories $orderSchedulingCategories = null;

	private ?OrderStates $orderStates = null;

	private ?InvoiceStates $invoiceStates = null;

	private ?OutgoingStates $outgoingStates = null;

	private ?OutgoingTaxes $outgoingTaxes = null;

	private ?CustomerStates $customerStates = null;

	private ?ProjectStates $projectStates = null;

	private ?OpenTaskStates $openTaskStates = null;

	private ?OpenTaskCategories $openTaskCategories = null;

	private ?PublicHolidays $publicHolidays = null;

	private ?Expenses $expenses = null;


	public function __construct(
		private readonly ClientConfig $config,
		?TransportInterface $transport = null,
	) {
		$this->transport = $transport ?? new CurlTransport($config);
	}



	public function config(): ClientConfig
	{
		return $this->config;
	}


	public function customers(): Customers
	{
		return $this->customers ??= new Customers($this);
	}

	public function contacts(): Contacts
	{
		return $this->contacts ??= new Contacts($this);
	}

	public function customerContacts(): CustomerContacts
	{
		return $this->customerContacts ??= new CustomerContacts($this);
	}

	public function projects(): Projects
	{
		return $this->projects ??= new Projects($this);
	}

	public function outgoings(): Outgoings
	{
		return $this->outgoings ??= new Outgoings($this);
	}

	public function distributors(): Distributors
	{
		return $this->distributors ??= new Distributors($this);
	}

	public function articles(): Articles
	{
		return $this->articles ??= new Articles($this);
	}

	public function users(): Users
	{
		return $this->users ??= new Users($this);
	}

	public function timeReports(): TimeReports
	{
		return $this->timeReports ??= new TimeReports($this);
	}

	public function timeReportExpenses(): TimeReportExpenses
	{
		return $this->timeReportExpenses ??= new TimeReportExpenses($this);
	}

	public function openTasks(): OpenTasks
	{
		return $this->openTasks ??= new OpenTasks($this);
	}

	public function supportTickets(): SupportTickets
	{
		return $this->supportTickets ??= new SupportTickets($this);
	}

	public function offers(): Offers
	{
		return $this->offers ??= new Offers($this);
	}

	public function orders(): Orders
	{
		return $this->orders ??= new Orders($this);
	}

	public function invoices(): Invoices
	{
		return $this->invoices ??= new Invoices($this);
	}

	public function events(): Events
	{
		return $this->events ??= new Events($this);
	}

	public function workPackages(): WorkPackages
	{
		return $this->workPackages ??= new WorkPackages($this);
	}

	public function settings(): Settings
	{
		return $this->settings ??= new Settings($this);
	}

	public function userAbsences(): UserAbsences
	{
		return $this->userAbsences ??= new UserAbsences($this);
	}

	public function myTimeReports(): MyTimeReports
	{
		return $this->myTimeReports ??= new MyTimeReports($this);
	}

	public function myUser(): MyUser
	{
		return $this->myUser ??= new MyUser($this);
	}

	public function comments(): Comments
	{
		return $this->comments ??= new Comments($this);
	}

	public function userLocation(): UserLocation
	{
		return $this->userLocation ??= new UserLocation($this);
	}

	public function assistant(): Assistant
	{
		return $this->assistant ??= new Assistant($this);
	}

	public function salutations(): Salutations
	{
		return $this->salutations ??= new Salutations($this);
	}

	public function countries(): Countries
	{
		return $this->countries ??= new Countries($this);
	}

	public function cantons(): Cantons
	{
		return $this->cantons ??= new Cantons($this);
	}

	public function currencies(): Currencies
	{
		return $this->currencies ??= new Currencies($this);
	}

	public function departments(): Departments
	{
		return $this->departments ??= new Departments($this);
	}

	public function places(): Places
	{
		return $this->places ??= new Places($this);
	}

	public function encashments(): Encashments
	{
		return $this->encashments ??= new Encashments($this);
	}

	public function languages(): Languages
	{
		return $this->languages ??= new Languages($this);
	}

	public function absenceTypes(): AbsenceTypes
	{
		return $this->absenceTypes ??= new AbsenceTypes($this);
	}

	public function articleCategories(): ArticleCategories
	{
		return $this->articleCategories ??= new ArticleCategories($this);
	}

	public function articleTaxes(): ArticleTaxes
	{
		return $this->articleTaxes ??= new ArticleTaxes($this);
	}

	public function articleUnits(): ArticleUnits
	{
		return $this->articleUnits ??= new ArticleUnits($this);
	}

	public function bankAccounts(): BankAccounts
	{
		return $this->bankAccounts ??= new BankAccounts($this);
	}

	public function emailTemplates(): EmailTemplates
	{
		return $this->emailTemplates ??= new EmailTemplates($this);
	}

	public function offerStates(): OfferStates
	{
		return $this->offerStates ??= new OfferStates($this);
	}

	public function orderCategories(): OrderCategories
	{
		return $this->orderCategories ??= new OrderCategories($this);
	}

	public function orderSchedulingCategories(): OrderSchedulingCategories
	{
		return $this->orderSchedulingCategories ??= new OrderSchedulingCategories($this);
	}

	public function orderStates(): OrderStates
	{
		return $this->orderStates ??= new OrderStates($this);
	}

	public function invoiceStates(): InvoiceStates
	{
		return $this->invoiceStates ??= new InvoiceStates($this);
	}

	public function outgoingStates(): OutgoingStates
	{
		return $this->outgoingStates ??= new OutgoingStates($this);
	}

	public function outgoingTaxes(): OutgoingTaxes
	{
		return $this->outgoingTaxes ??= new OutgoingTaxes($this);
	}

	public function customerStates(): CustomerStates
	{
		return $this->customerStates ??= new CustomerStates($this);
	}

	public function projectStates(): ProjectStates
	{
		return $this->projectStates ??= new ProjectStates($this);
	}

	public function openTaskStates(): OpenTaskStates
	{
		return $this->openTaskStates ??= new OpenTaskStates($this);
	}

	public function openTaskCategories(): OpenTaskCategories
	{
		return $this->openTaskCategories ??= new OpenTaskCategories($this);
	}

	public function publicHolidays(): PublicHolidays
	{
		return $this->publicHolidays ??= new PublicHolidays($this);
	}

	public function expenses(): Expenses
	{
		return $this->expenses ??= new Expenses($this);
	}



	/**
	 * Perform a raw API request and decode JSON.
	 *
	 * @param array<string, scalar|null> $query
	 * @param array<string, mixed>|null $jsonBody
	 * @return array<string, mixed>
	 */
	public function request(
		string $method,
		string $path,
		array $query = [],
		?array $jsonBody = null,
	): array {
		$response = $this->send($method, $path, $query, $jsonBody);

		$body = [];
		if ($response->body !== '') {
			try {
				$decoded = $response->json();
				$body = is_array($decoded) ? $decoded : [];
			} catch (\Throwable $e) {
				if ($response->statusCode >= 400) {
					throw $this->mapError($response->statusCode, ['error' => $response->body], $e);
				}
				throw new ApiException('Invalid JSON response: ' . $e->getMessage(), $response->statusCode, null, $e);
			}
		}

		if ($response->statusCode >= 400) {
			throw $this->mapError($response->statusCode, $body);
		}

		/** @var array<string, mixed> $body */
		return $body;
	}



	/**
	 * Perform a raw API request without JSON decoding (e.g. binary PDF).
	 *
	 * @param array<string, scalar|null> $query
	 * @param array<string, mixed>|null $jsonBody
	 */
	public function requestRaw(
		string $method,
		string $path,
		array $query = [],
		?array $jsonBody = null,
	): Response {
		$response = $this->send($method, $path, $query, $jsonBody);

		if ($response->statusCode >= 400) {
			$body = [];
			if ($response->body !== '') {
				try {
					$decoded = $response->json();
					$body = is_array($decoded) ? $decoded : ['error' => $response->body];
				} catch (\Throwable) {
					$body = ['error' => $response->body];
				}
			}
			throw $this->mapError($response->statusCode, $body);
		}

		return $response;
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @param array<string, mixed>|null $jsonBody
	 */
	private function send(
		string $method,
		string $path,
		array $query = [],
		?array $jsonBody = null,
	): Response {
		$url = $this->config->normalizedBaseUrl() . '/' . ltrim($path, '/');

		$filteredQuery = [];
		foreach ($query as $key => $value) {
			if ($value === null) {
				continue;
			}
			$filteredQuery[$key] = $value;
		}

		if ($filteredQuery !== []) {
			$url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($filteredQuery);
		}

		$headers = [
			'Accept' => 'application/json',
			'X-Tenant' => $this->config->tenant,
			'X-API-Key' => $this->config->apiKey,
		];

		if ($this->config->userAgent !== null && $this->config->userAgent !== '') {
			$headers['User-Agent'] = $this->config->userAgent;
		}

		if ($jsonBody !== null) {
			$headers['Content-Type'] = 'application/json';
		}

		try {
			return $this->transport->request($method, $url, $headers, $jsonBody);
		} catch (TransportException $e) {
			throw $e;
		} catch (\Throwable $e) {
			throw new TransportException($e->getMessage(), 0, null, $e);
		}
	}



	/**
	 * @param array<string, mixed> $body
	 */
	private function mapError(int $statusCode, array $body, ?\Throwable $previous = null): ApiException
	{
		$message = $this->extractErrorMessage($body) ?? ('HTTP ' . $statusCode);

		return match (true) {
			$statusCode === 401, $statusCode === 403 => new AuthenticationException($message, $statusCode, $body, $previous),
			$statusCode === 404 => new NotFoundException($message, $statusCode, $body, $previous),
			$statusCode === 400, $statusCode === 422 => new ValidationException($message, $statusCode, $body, $previous),
			$statusCode === 429 => new RateLimitException($message, $statusCode, $body, $previous),
			default => new ApiException($message, $statusCode, $body, $previous),
		};
	}



	/**
	 * @param array<string, mixed> $body
	 */
	private function extractErrorMessage(array $body): ?string
	{
		if (isset($body['error']) && is_string($body['error']) && $body['error'] !== '') {
			return $body['error'];
		}

		if (isset($body['messages']) && is_array($body['messages'])) {
			$parts = [];
			foreach ($body['messages'] as $key => $value) {
				if (is_string($value)) {
					$parts[] = is_string($key) ? $key . ': ' . $value : $value;
				} elseif (is_array($value)) {
					$parts[] = is_string($key) ? $key . ': ' . implode(', ', array_map('strval', $value)) : implode(', ', array_map('strval', $value));
				}
			}
			if ($parts !== []) {
				return implode('; ', $parts);
			}
		}

		if (isset($body['message']) && is_string($body['message']) && $body['message'] !== '') {
			return $body['message'];
		}

		return null;
	}
}
