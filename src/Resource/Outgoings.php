<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Http\Response;

/**
 * Outgoings API resource (`/api/v3/outgoings`).
 */
final class Outgoings extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/outgoings';
	}



	/**
	 * Get PDF archive metadata for an outgoing.
	 *
	 * @return array<string, mixed>
	 */
	public function getPdf(int $outgoingId): array
	{
		return $this->httpGet($this->path() . '/' . $outgoingId . '/pdf');
	}



	/**
	 * Upload a PDF archive (JSON + Base64). Returns metadata only.
	 *
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function uploadPdf(int $outgoingId, array $payload): array
	{
		return $this->httpPost($this->path() . '/' . $outgoingId . '/pdf', $payload);
	}



	/**
	 * Download PDF binary content.
	 */
	public function downloadPdfContent(int $outgoingId): Response
	{
		return $this->client->requestRaw(
			'GET',
			$this->path() . '/' . $outgoingId . '/pdf/content',
		);
	}



	/**
	 * Download PDF as JSON with `content_base64`.
	 *
	 * @return array<string, mixed>
	 */
	public function downloadPdfContentBase64(int $outgoingId): array
	{
		return $this->httpGet(
			$this->path() . '/' . $outgoingId . '/pdf/content',
			['encoding' => 'base64'],
		);
	}
}
