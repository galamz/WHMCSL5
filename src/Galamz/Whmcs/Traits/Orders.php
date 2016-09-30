<?php namespace Galamz\Whmcs\Traits;

trait Orders {

	public function addOrder($id,$params)
	{
		$params['clientid']=$id;

		$response= $this->getJson('addorder',$params);

		return $response;
	}
}