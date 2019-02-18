<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 5:11
 */

final class RestApiTest extends \PHPUnit\Framework\TestCase {

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient = null;

    protected function setUp(): void
    {
        $this->httpClient = new \GuzzleHttp\Client(['base_uri' => 'localhost:9000']);
    }


    public function testApiIsAlive()
    {
        $response = $this->httpClient->request('GET', '/api/v1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody());
    }

    public function testWrongMethodError()
    {
        $response = $this->httpClient->request('PATCH', '/api/v1/sendSms', ['http_errors' => false]);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertJson($response->getBody());
    }

    public function testAbsentRouteError()
    {
        $response = $this->httpClient->request('POST', '/api/v999/absentMethod', ['http_errors' => false]);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertJson($response->getBody());
    }


    public function testSmsSendingEmptyRequestValidation()
    {
        $response = $this->httpClient->request('POST', '/api/v1/sendSms', ['http_errors' => false]);
        //No request body
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertJson($response->getBody());
    }

    public function testSmsSendingAbsentRequiredAttributeValidation()
    {
        $response = $this->httpClient->request('POST', '/api/v1/sendSms', [
            'http_errors' => false,
            'json' => [
                'originator'    => 'PHPUnit',
                'message'       => 'test message from unit test'
            ]
        ]);
        $this->assertEquals(422, $response->getStatusCode());
        $this->assertJson($response->getBody());
    }

    public function testSmsSendingTooLongMessageValidation()
    {
        $response = $this->httpClient->request('POST', '/api/v1/sendSms', [
            'http_errors' => false,
            'json' => [
                'recipient'     => '31612345678',
                'originator'    => 'PHPUnit',
                'message'       => str_pad('test message from unit test', 161, 'pad')
            ]
        ]);
        $this->assertEquals(422, $response->getStatusCode());
        $this->assertJson($response->getBody());
    }
}