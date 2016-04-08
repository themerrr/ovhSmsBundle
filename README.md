# OvhSmsBundle

   Send sms through ovh SOAP API


### Installation :

#### Via Composer :
	$composer require send-sms/ovh-sms-bundle "dev-master"


#### Enable the bundle in the kernel:

	<?php
	// app/AppKernel.php

	public function registerBundles()
		{
   	 		$bundles = array(
             // ...
            new sms-sender/ovh-smsBundle(),
       		 // ...
    	);
	}



#### Configure the ovh Account parameter :

	ovh_params:
      	wsdl_root: web/soapi/soapi-re-1.63.wsdl
      	session_params:
        	serviceName: %your_service_name%
        	login: %your_identifiant%
        	password: %your_password%
        	country: fr 
        	sender: "sender"
      	msg_params:
        	smsValidity: 2880  #The maximum time -in minute(s)- before the message is dropped
        	smsClass: 1  #The sms class the class is phone display
        	smsDeferred: 0 #The time -in minute(s)- to wait before sending the message
        	smsPriority: 1 #The priority of the message this case is high
        	smsCoding: 1 #The sms coding 1=> 7bits
        	tag: ""
        	noStop: true

#### Usage :

	public function indexAction()
    {
        $sms=$this->container->get('send_sms_service');
        
        // Set receiver's Number
        $receiver="+21652989551";
        
        //set message
        $message="bonjour";
        
        //call the sendSms() function
        $sms->sendSms($receiver,$message);

        return $this->render('testOvhBundle:Default:index.html.twig');
    }




