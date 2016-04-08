<?php
namespace ovhSmsBundle\service;
/**
 * Created by PhpStorm.
 * User: themer
 * Date: 07/04/16
 * Time: 02:21 م
 */


class sendSmsService
{
    private $container;
    private $ovhParams;
    private $ovhMsgParams;

    public function __construct($container)
    {
        $this->container=$container;
        $this->ovhParams = $this->container->getParameter ('ovh_params');
        $this->ovhMsgParams = $this->ovhParams ['msg_params'];
        if (!isset($this->ovhMsgParams)) {
            throw new \Exception('parameters is missed');
        }

    }

    public function sendSms($receiver, $message) {
        // Send a SMS


        try {
            $soap = new \SoapClient("https://www.ovh.com/soapi/soapi-re-1.63.wsdl");

            // login
            $session = $soap->login ( $this->ovhParams ['session_params'] ['login'], $this->ovhParams ['session_params'] ['password'], $this->ovhParams ['session_params'] ['country'], false );
            echo "login successfull\n";

            // telephonySmsSend
            $result = $soap->telephonySmsSend ($session,$this->ovhParams ['session_params'] ['serviceName'], $this->ovhParams ['session_params'] ['sender'], $receiver, $message, $this->ovhMsgParams ['smsValidity'], $this->ovhMsgParams ['smsClass'], $this->ovhMsgParams ['smsDeferred'], $this->ovhMsgParams ['smsPriority'], $this->ovhMsgParams ['smsCoding'], $this->ovhMsgParams ['tag'], $this->ovhMsgParams ['noStop'] );
            echo "telephonySmsSend successfull\n";
            print_r ( $result );
            // logout
            $soap->logout ( $session );
            echo "logout successfull\n";
        } catch ( \SoapFault $fault ) {
            echo $fault;
        }
    }
}