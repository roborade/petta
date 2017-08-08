<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use InstagramAPI\Instagram;
use Kint;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
	    $feedArray = array();
		$url = 'https://www.instagram.com/pettaconstruction/media/';
		$userFeed = json_decode($this->CallInstaAPI('GET', $url), true);
		foreach($userFeed['items'] as $item){
		    $feedArray[] = $item['images']['standard_resolution']['url'];
	    }		
        return $this->render('default/index.html.twig', array('insta'=>$feedArray));
    }
	/**
     * @Route("/test", name="insta")
     */    
    public function instaAction(Request $request){
	    $url = 'https://www.instagram.com/pettaconstruction/media/';
	    
// 	    $userFeed = json_decode($this->CallInstaAPI('GET', $url), true);
// 	    d( $userFeed );
	    
/*
	    foreach($userFeed['items'] as $item){
		    echo('<img src ="'.$item['images']['standard_resolution']['url'].'/>');
	    }
*/
	    return $this->render('default/test.html.twig');
    }
    
    private function CallInstaAPI($method, $url, $data = false)
	{
	    $curl = curl_init();
	
	    switch ($method)
	    {
	        case "POST":
	            curl_setopt($curl, CURLOPT_POST, 1);
	
	            if ($data)
	                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	            break;
	        case "PUT":
	            curl_setopt($curl, CURLOPT_PUT, 1);
	            break;
		case "GET";
		   //curl_setopt($curl, CURLOPT_GET, 1);
	        default:
	            if ($data)
	                $url = sprintf("%s?%s", $url, http_build_query($data));
	    }
	
	    // Optional Authentication:
	    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
	    $result = curl_exec($curl);
	
	    curl_close($curl);
	
	    return $result;
	}
}
