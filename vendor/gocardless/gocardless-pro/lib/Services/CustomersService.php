<?php
/**
 * WARNING: Do not edit by hand, this file was generated by Crank:
 *
 * https://github.com/gocardless/crank
 */

namespace GoCardlessPro\Services;

use \GoCardlessPro\Core\Paginator;
use \GoCardlessPro\Core\Util;
use \GoCardlessPro\Core\ListResponse;
use \GoCardlessPro\Resources\Customer;
use \GoCardlessPro\Core\Exception\InvalidStateException;


/**
 * Service that provides access to the Customer
 * endpoints of the API
 *
 * @method create()
 * @method list()
 * @method get()
 * @method update()
 * @method remove()
 */
class CustomersService extends BaseService
{

    protected $envelope_key   = 'customers';
    protected $resource_class = '\GoCardlessPro\Resources\Customer';


    /**
     * Create a customer
     *
     * Example URL: /customers
     *
     * @param  string[mixed] $params An associative array for any params
     * @return Customer
     **/
    public function create($params = array())
    {
        $path = "/customers";
        if(isset($params['params'])) { 
            $params['body'] = json_encode(array($this->envelope_key => (object)$params['params']));
        
            unset($params['params']);
        }

        
        try {
            $response = $this->api_client->post($path, $params);
        } catch(InvalidStateException $e) {
            if ($e->isIdempotentCreationConflict()) {
                if ($this->api_client->error_on_idempotency_conflict) {
                    throw $e;
                }
                return $this->get($e->getConflictingResourceId());
            }

            throw $e;
        }
        

        return $this->getResourceForResponse($response);
    }

    /**
     * List customers
     *
     * Example URL: /customers
     *
     * @param  string[mixed] $params An associative array for any params
     * @return ListResponse
     **/
    protected function _doList($params = array())
    {
        $path = "/customers";
        if(isset($params['params'])) { $params['query'] = $params['params'];
            unset($params['params']);
        }

        
        $response = $this->api_client->get($path, $params);
        

        return $this->getResourceForResponse($response);
    }

    /**
     * Get a single customer
     *
     * Example URL: /customers/:identity
     *
     * @param  string        $identity Unique identifier, beginning with "CU".
     * @param  string[mixed] $params   An associative array for any params
     * @return Customer
     **/
    public function get($identity, $params = array())
    {
        $path = Util::subUrl(
            '/customers/:identity',
            array(
                
                'identity' => $identity
            )
        );
        if(isset($params['params'])) { $params['query'] = $params['params'];
            unset($params['params']);
        }

        
        $response = $this->api_client->get($path, $params);
        

        return $this->getResourceForResponse($response);
    }

    /**
     * Update a customer
     *
     * Example URL: /customers/:identity
     *
     * @param  string        $identity Unique identifier, beginning with "CU".
     * @param  string[mixed] $params   An associative array for any params
     * @return Customer
     **/
    public function update($identity, $params = array())
    {
        $path = Util::subUrl(
            '/customers/:identity',
            array(
                
                'identity' => $identity
            )
        );
        if(isset($params['params'])) { 
            $params['body'] = json_encode(array($this->envelope_key => (object)$params['params']));
        
            unset($params['params']);
        }

        
        $response = $this->api_client->put($path, $params);
        

        return $this->getResourceForResponse($response);
    }

    /**
     * Remove a customer
     *
     * Example URL: /customers/:identity
     *
     * @param  string        $identity Unique identifier, beginning with "CU".
     * @param  string[mixed] $params   An associative array for any params
     * @return Customer
     **/
    public function remove($identity, $params = array())
    {
        $path = Util::subUrl(
            '/customers/:identity',
            array(
                
                'identity' => $identity
            )
        );
        if(isset($params['params'])) { $params['query'] = $params['params'];
            unset($params['params']);
        }

        
        $response = $this->api_client->delete($path, $params);
        

        return $this->getResourceForResponse($response);
    }

    /**
     * List customers
     *
     * Example URL: /customers
     *
     * @param  string[mixed] $params
     * @return Paginator
     **/
    public function all($params = array())
    {
        return new Paginator($this, $params);
    }

}
