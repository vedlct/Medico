<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    //
    public function dailyAllAppointment(){

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $userName='fpeon';
        $password='@Foodpeon.2018';
        $brand='Non Brand';

        $sms="Dear Patient";
        $destination='01676595109';

        $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($destination)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));

        return $json;

        $totalSms = Appointment::select('appointment.*','doctor.firstName','doctor.lastName','patient.patientName','patient.phone')
            ->leftJoin('doctor','doctor.doctorId','appointment.fkdoctorId')
            ->leftJoin('patient','patient.patientId','appointment.fkpatientId')
            ->whereRaw('Date(appointment_date) = CURDATE()')
            ->where('status',USER_STATUS['Active'])
            ->get();



        foreach ($totalSms as $tS){

            $destination=$tS->phone;




            $json = file_get_contents("https://msms.techcloudltd.com/pages/RequestSMS.php?user_name=".urlencode($userName)."&pass_word=".urlencode($password)."&brand=".urlencode($brand)."&type=1&destination=".urlencode($destination)."&sms=".urlencode($sms), false, stream_context_create($arrContextOptions));


            $data=array();

            if (substr($json, 0, 3)== "404" || substr($json, 0, 3)== "405" ){

                $data=array(
                    'message'=>'Wrong User Name or password of Sms Config!',
                );

                //  return back()->with('message', 'Wrong User Name or password of Sms Config!');
            }elseif (substr($json, 0, 3)== "407"){

                $data=array(
                    'message'=>'Wrong Brand Name of Sms Config!',
                );

                // return back()->with('message', 'Wrong Brand Name of Sms Config!');
            }elseif (substr($json, 0, 3)== "409"){

                $data=array(
                    'message'=>'sms Sent cancelled for insufficient balance!',
                );

                // return back()->with('message', 'sms Sent cancelled for insufficient balance!');
            }elseif (substr($json, 0, 3)== "400"){

                $data=array(
                    'message'=>'Sms Send SuccessFully!',
                );
                // return back()->with('message', 'Sms Send SuccessFully!');
            }elseif (substr($json, 0, 3)== "408"){

                $data=array(
                    'message'=>'Invalid number!',
                );
                // return back()->with('message', 'Invalid number!');
            }else{

                $data=array(
                    'message'=>'bill paid',
                );

                // $message='Monthly Cable bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;
                //return  $data;

            }

        }

        return $data;



    }
}
