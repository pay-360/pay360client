<?php

namespace pay360;

class pay360client {
    var $postURL = 'http://localhost:82/';

    var $paymentIntentURI = 'gw/v1_0/paymentIntent';
    var $checkPaymentStatusURI = 'gw/checkPaymentStatus';

    var $paymentIntentLink;
    var $checkPaymentStatusLink;

    var $username = 'XdW81wR9YB'; // All trigger pay360 stripe will under Markkhor
    var $password = "OoB9S7fnjFAyyI2RcVGynkW2fR4N17EqUhdzR9fQ";  //This need to change (follow live pay.360.my db oauth secret)

    var $success_url = 'abc_success_url';
    var $status_url = 'abc_status_url';
    var $cancel_url = 'abc_cancel_url';

    var $statusCode = [
        1   => 'Pending Payment',
        200 => 'OK',
        400 => 'Missing parameters or invalid field type',
        401 => 'Invalid Username or password',
        403 => 'Message API not enabled, requested IP not whitelisted or not enabled',
        412 => 'Account suspended / Terminated / Not activated',
        413 => 'Account under observation mode, limited features enabled',
        500 => 'Internal server error'
    ];

    var $testingMode = false;

    public function __construct() {
        $this->paymentIntentLink = $this->postURL . $this->paymentIntentURI;
        $this->checkPaymentStatusLink = $this->postURL . $this->checkPaymentStatusURI;
    }

    /**
     * PW241122 Whenever user want to trigger payment, they create payment intent to inform pay360 to create the payment session 
     */
	public function paymentIntent($payment_intent_info) {

        //PW
        $refID = $payment_intent_info['refID'];
        $line_items = $payment_intent_info['line_items'];
        $customer_email = $payment_intent_info['email'];
        $paymentMethod = $payment_intent_info['mode'];
        $success_url = $payment_intent_info['success_url'];
        $cancel_url = $payment_intent_info['cancel_url'];
        $status_url = $payment_intent_info['status_url'];
        
        $pay360Session = [ 
            'ref_id'        => $refID, 
            'line_items'    => $line_items, 
            'customer'      => [ 'email' => $customer_email, ], 
            'mode'          => $paymentMethod, 
            'success_url'   => $success_url, 
            'cancel_url'    => $cancel_url,
            'status_url'    => $status_url
        ];
        
        if ($this->testingMode)
            $pay360Session['testing_mode'] = $this->testingMode;
        $url = $this->paymentIntentLink;
        $data = [
            'user'      => urlencode($this->username),
            'pass'      => urlencode($this->password),
            'session'   => $pay360Session,
        ];

        $response = $this->curlVisit($url, $data);
        return $response;
	}

    public function checkPaymentStatus($refID) {
        $url = $this->checkPaymentStatusLink;
        $data = [
            'user'  => urlencode($this->username),
            'pass'  => urlencode($this->password),
            'reference_id'  => $refID
        ];

        $response = $this->curlVisit($url, $data);
        return $response;
    }

    // Only real visit in production server
    private function curlVisit($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_3);
        curl_setopt($ch, CURLOPT_SSLVERSION, 7); // <- TLSv1_3 version
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "content-type: application/json"
        ]);

        $retry = 0;
        $response = null;
        do {
            $response = curl_exec($ch);
            if ($response == FALSE) {
                $retry ++;
                if ($retry > 5) {
                    $response = 'TimeOut';
                }
            }
        } while($response == FALSE);
        curl_close($ch);
        return $response;
    }
}
