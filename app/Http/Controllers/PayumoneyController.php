<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayumoneyController extends Controller
{   
    public function index(){
		return view('index');
    }
    public function send_details(){
		if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
			//Request hash
			$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	
			if(strcasecmp($contentType, 'application/json') == 0){
				$data = json_decode(file_get_contents('php://input'));
				$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
				$json=array();
				$json['success'] = $hash;
		    	echo json_encode($json);
			}
			exit(0);
		}
	}
	public function getCallbackUrl(){
		$postdata= $_POST;
		$msg = '';
		if (isset($postdata ['key'])) {
			$key				=   $postdata['key'];
			$txnid				= 	$postdata['txnid'];
		    $amount    		    = 	$postdata['amount'];
			$productInfo 		= 	$postdata['productinfo'];
			$firstname   		= 	$postdata['firstname'];
			$email     		    =	$postdata['email'];
			$udf5				=   $postdata['udf5'];
			$mihpayid			=	$postdata['mihpayid'];
			$status			    = 	$postdata['status'];
			$resphash			= 	$postdata['hash'];
			if ($status == 'success') {
				return view('response',compact(['key','txnid','amount','productInfo','firstname','email','udf5','mihpayid','status','resphash']));
			}
			else {
                dd('Sorry for your failed transaction');
			} 
		}
		else exit(0);
	}
}
