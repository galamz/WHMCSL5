<?php namespace Galamz\Whmcs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Galamz\Whmcs\Traits\Clients;
use Galamz\Whmcs\Traits\Invoices;
use Galamz\Whmcs\Traits\Tickets;
use Galamz\Whmcs\Traits\Orders;

class WhmcsHandler{
    use Clients,Tickets,Invoices,Orders;

    protected $client;

    public function __construct(Client $client){
        $this->client = $client;
    }

    /**
     * Make a request to whmcs api.Some whmcs response not working as expected.
     *
     * @param $action
     * @param null $params
     * @return bool
     */
    public function getJson($action,$params=NULL)
    {
        $data=[
            'username'=>\Config::get('whmcs.username'),
            'password'=>md5(\Config::get('whmcs.password')),
            'action'=>$action,
            'responsetype'=>'json'
        ];

        $data = ($params===NULL) ?: array_merge($data,$params);

        try{
            $response = $this->client->request('POST', $this->dataUrl(), [
                'form_params' => $data
            ]);

            $data = json_decode((string)$response->getBody());

            return $data;
        }
        catch (ClientException $e)
        {
            return false;
        }
    }

    /**
     * Generate Whmcs api request url.
     *
     * @param $data
     * @return string
     */
    public function dataUrl()
    {
        return  \Config::get('whmcs.url');
    }
}
