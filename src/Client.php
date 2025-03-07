<?php

class GetBrazaClient {
    private $applicationId;
    private $apiKey;
    private $accountNumber;
    private $baseUrl;

    public function __construct($applicationId, $apiKey, $accountNumber, $baseUrl = "https://sandbox-api.getbraza.uk/v2/business") {
        $this->applicationId = $applicationId;
        $this->apiKey = $apiKey;
        $this->accountNumber = $accountNumber;
        $this->baseUrl = $baseUrl;
    }

    private function request($method, $endpoint, $data = []) {
        $headers = [
            "x-application-id: " . $this->applicationId,
            "x-api-key: " . $this->apiKey,
            "x-account-number: " . $this->accountNumber,
            "Content-Type: application/json"
        ];
        $url = $this->baseUrl . $endpoint;
        $options = [
            "http" => [
                "header" => implode("\r\n", $headers),
                "method" => $method,
                "content" => json_encode($data)
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }

    public function inputTransaction($data) {
        return $this->request("POST", "/v1/", $data);
    }

    public function retrieveTransactions() {
        return $this->request("POST", "/v1/transactions");
    }

    public function withdraw($data) {
        return $this->request("POST", "/v1/withdraw", $data);
    }

    public function getQuote($pair, $markupType = null, $markupValue = null) {
        $params = ["pair" => $pair];
        if ($markupType) $params["markup_type"] = $markupType;
        if ($markupValue) $params["markup_value"] = $markupValue;
        return $this->request("GET", "/v1/quote", $params);
    }

    public function internalTransfer($data) {
        return $this->request("POST", "/v1/internal-transfer", $data);
    }

    public function auth() {
        return $this->request("POST", "/v1/auth");
    }

    public function getBalance() {
        return $this->request("GET", "/v1/balance");
    }
}