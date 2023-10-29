<?php
//
// WARNING: Do not edit by hand, this file was generated by Crank:
// https://github.com/gocardless/crank
//

namespace GoCardlessPro\Integration;

class RedirectFlowsIntegrationTest extends IntegrationTestBase
{
    public function testResourceModelExists()
    {
        $obj = new \GoCardlessPro\Resources\RedirectFlow(array());
        $this->assertNotNull($obj);
    }
    
    public function testRedirectFlowsCreate()
    {
        $fixture = $this->loadJsonFixture('redirect_flows')->create;
        $this->stub_request($fixture);

        $service = $this->client->redirectFlows();
        $response = call_user_func_array(array($service, 'create'), (array)$fixture->url_params);

        $body = $fixture->body->redirect_flows;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\RedirectFlow', $response);

        $this->assertEquals($body->confirmation_url, $response->confirmation_url);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->description, $response->description);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->links, $response->links);
        $this->assertEquals($body->mandate_reference, $response->mandate_reference);
        $this->assertEquals($body->metadata, $response->metadata);
        $this->assertEquals($body->redirect_url, $response->redirect_url);
        $this->assertEquals($body->scheme, $response->scheme);
        $this->assertEquals($body->session_token, $response->session_token);
        $this->assertEquals($body->success_redirect_url, $response->success_redirect_url);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    public function testRedirectFlowsCreateWithIdempotencyConflict()
    {
        $fixture = $this->loadJsonFixture('redirect_flows')->create;

        $idempotencyConflictResponseFixture = $this->loadFixture('idempotent_creation_conflict_invalid_state_error');

        // The POST request responds with a 409 to our original POST, due to an idempotency conflict
        $this->mock->append(new \GuzzleHttp\Psr7\Response(409, [], $idempotencyConflictResponseFixture));

        // The client makes a second request to fetch the resource that was already
        // created using our idempotency key. It responds with the created resource,
        // which looks just like the response for a successful POST request.
        $this->mock->append(new \GuzzleHttp\Psr7\Response(200, [], json_encode($fixture->body)));

        $service = $this->client->redirectFlows();
        $response = call_user_func_array(array($service, 'create'), (array)$fixture->url_params);
        $body = $fixture->body->redirect_flows;

        $this->assertInstanceOf('\GoCardlessPro\Resources\RedirectFlow', $response);

        $this->assertEquals($body->confirmation_url, $response->confirmation_url);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->description, $response->description);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->links, $response->links);
        $this->assertEquals($body->mandate_reference, $response->mandate_reference);
        $this->assertEquals($body->metadata, $response->metadata);
        $this->assertEquals($body->redirect_url, $response->redirect_url);
        $this->assertEquals($body->scheme, $response->scheme);
        $this->assertEquals($body->session_token, $response->session_token);
        $this->assertEquals($body->success_redirect_url, $response->success_redirect_url);
        

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $conflictRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $conflictRequest->getUri()->getPath());
        $getRequest = $this->history[1]['request'];
        $this->assertEquals($getRequest->getUri()->getPath(), '/redirect_flows/ID123');
    }
    
    public function testRedirectFlowsGet()
    {
        $fixture = $this->loadJsonFixture('redirect_flows')->get;
        $this->stub_request($fixture);

        $service = $this->client->redirectFlows();
        $response = call_user_func_array(array($service, 'get'), (array)$fixture->url_params);

        $body = $fixture->body->redirect_flows;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\RedirectFlow', $response);

        $this->assertEquals($body->confirmation_url, $response->confirmation_url);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->description, $response->description);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->links, $response->links);
        $this->assertEquals($body->mandate_reference, $response->mandate_reference);
        $this->assertEquals($body->metadata, $response->metadata);
        $this->assertEquals($body->redirect_url, $response->redirect_url);
        $this->assertEquals($body->scheme, $response->scheme);
        $this->assertEquals($body->session_token, $response->session_token);
        $this->assertEquals($body->success_redirect_url, $response->success_redirect_url);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    
    public function testRedirectFlowsComplete()
    {
        $fixture = $this->loadJsonFixture('redirect_flows')->complete;
        $this->stub_request($fixture);

        $service = $this->client->redirectFlows();
        $response = call_user_func_array(array($service, 'complete'), (array)$fixture->url_params);

        $body = $fixture->body->redirect_flows;
    
        $this->assertInstanceOf('\GoCardlessPro\Resources\RedirectFlow', $response);

        $this->assertEquals($body->confirmation_url, $response->confirmation_url);
        $this->assertEquals($body->created_at, $response->created_at);
        $this->assertEquals($body->description, $response->description);
        $this->assertEquals($body->id, $response->id);
        $this->assertEquals($body->links, $response->links);
        $this->assertEquals($body->mandate_reference, $response->mandate_reference);
        $this->assertEquals($body->metadata, $response->metadata);
        $this->assertEquals($body->redirect_url, $response->redirect_url);
        $this->assertEquals($body->scheme, $response->scheme);
        $this->assertEquals($body->session_token, $response->session_token);
        $this->assertEquals($body->success_redirect_url, $response->success_redirect_url);
    

        $expectedPathRegex = $this->extract_resource_fixture_path_regex($fixture);
        $dispatchedRequest = $this->history[0]['request'];
        $this->assertRegExp($expectedPathRegex, $dispatchedRequest->getUri()->getPath());
    }

    
}
