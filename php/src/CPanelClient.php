<?php
use PHPUnit\Runner\Exception;
use GuzzleHttp\Psr7\Request;
use function GuzzleHttp\json_decode;

class CPanelClient {

    private $baseUrl;
    private $apiKey;

    function __construct($baseUrl, $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    /**
     * @return boolean True is disable account successfully
     */
    public function disableAccount($username, $reason = null) {
        $why = urlencode($reason);
        $path = "/json-api/suspendacct?api.version=1&user=$username&reason=$why";
        $data = $this->doRequest($path);
        return $data->metadata->result == 1;
    }

    public function enableAccount($username) {
        $path = "/json-api/unsuspendacct?api.version=1&user=$username";
        $data = $this->doRequest($path);
        return $data->metadata->result == 1;
    }

    private function doRequest($path) {
        $url = $this->baseUrl . $path;

        $request = new Request('GET', $url, ['Authorization' => 'whm root:' . $this->apiKey]);        
        
        $client = new \GuzzleHttp\Client();
        $response = $client->send($request);
        
        if ($response->getStatusCode() != 200) {
            throw new Exception('Result statusCode is ' . $response->getStatusCode());
        }

        $body = $response->getBody()->getContents();
        
        return json_decode($body);
    }

    public function findAccountByUsername($username) {
        $data = $this->doRequest('/json-api/listaccts?api.version=1&searchtype=user&search='.$username);

        return $data->data->acct[0];
    }

}