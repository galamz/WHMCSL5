<?php namespace Galamz\Whmcs\Traits;

trait Orders {

    public function addorder($clientid,$pid = 0,$billing = 'onetime')
    {


        $params['clientid']         = $clientid;
        $params['pid']              = $pid;
        $params['billingcycle']     = $billing;
        $params['paymentmethod']    = 'paypal';

        $params['noinvoice']        = true;
        $params['noinvoiceemail']   = true;
        $params['noemail']          = true;

        $response = $this->getJson('addorder',$params);

        return $response;
    }


    public function acceptorder($orderid){


        $params['orderid']              = $orderid;
        $params['sendemail']            = true;
        $params['sendemail']            = true;

        $response = $this->getJson('acceptorder',$params);

        return $response;
    }
}
