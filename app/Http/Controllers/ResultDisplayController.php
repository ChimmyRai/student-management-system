<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\studentuser;
use App\studentbio;
use Spatie\Image\Manipulations;
use App\resultHigherArts;
use App\resultHigherCom;
use App\resulthighersci;
use App\resultlower;
use App\resultmiddle;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;

class ResultDisplayController extends Controller
{
  public function index()
  {

$stdbio=studentbio::where('email', Auth::guard('student')->user()->email)->get();
$resultArts=resultHigherArts::where('email', Auth::guard('student')->user()->email)->get();

$resultCom=resultHigherCom::where('email', Auth::guard('student')->user()->email)->get();

$resultSci=resulthighersci::where('email', Auth::guard('student')->user()->email)->get();

$resultMiddle=resultmiddle::where('email', Auth::guard('student')->user()->email)->get();
$resultLow=resultlower::where('email', Auth::guard('student')->user()->email)->get();
//$stdbio=studentbio::where('email', Auth::guard('student')->user()->email)->get();
//
if(count($resultArts)>0)
{
  if(count($stdbio)<1)
  {

  return view('studentdashboard',['message'=>'There is no  information details in the school database that matches your email ID. Please cantact and request your class teacher to update your information details in the database']);

  }
return view('studentViews.showMyresultArts',['resultArts'=>$resultArts,'stdbio'=>$stdbio]);

}
if(count($resultCom)>0)
{
//  dd('dfadsf');
if(count($stdbio)<1)
{

return view('studentdashboard',['message'=>'There is no  information details in the school database that matches your email ID. Please cantact and request your class teacher to update your information details in the database']);

}
return view('studentViews.showMyresultCom',['resultCom'=>$resultCom,'stdbio'=>$stdbio]);
}
if(count($resultMiddle)>0)
{
  //dd('dfadsf');
  if(count($stdbio)<1)
  {

  return view('studentdashboard',['message'=>'There is no  information details in the school database that matches your email ID. Please cantact and request your class teacher to update your information details in the database']);

  }
  return view('studentViews.showMyresultMiddle',['resultMiddle'=>$resultMiddle,'stdbio'=>$stdbio]);
  //return view('studentViews.showMyresultMiddle',['resultMiddle'=>$resultMiddle,'stdbio'=>$stdbio]);
}
if(count($resultSci)>0)
{
  if(count($stdbio)<1)
  {

  return view('studentdashboard',['message'=>'There is no  information details in the school database that matches your email ID. Please cantact and request your class teacher to update your information details in the database']);

  }
//  dd('dfadsf');
return view('studentViews.showMyresultSci',['resultSci'=>$resultSci,'stdbio'=>$stdbio]);
}


if(count($resultLow)>0)
{
  if(count($stdbio)<1)
  {

  return view('studentdashboard',['message'=>'There is no  information details in the school database that matches your email ID. Please cantact and request your class teacher to update your information details in the database']);

  }
  //dd('dfadsf');
  return view('studentViews.showMyresultLower',['resultLow'=>$resultLow]);
}

return view('studentdashboard',['message'=>'Result might not have been uploaded']);
  }





public function generateViewForPdfDownload()
{
  $stdbio=studentbio::where('email', Auth::guard('student')->user()->email)->get();
  $resultArts=resultHigherArts::where('email', Auth::guard('student')->user()->email)->get();

  $resultCom=resultHigherCom::where('email', Auth::guard('student')->user()->email)->get();

  $resultSci=resulthighersci::where('email', Auth::guard('student')->user()->email)->get();

  $resultMiddle=resultmiddle::where('email', Auth::guard('student')->user()->email)->get();
  $resultLow=resultlower::where('email', Auth::guard('student')->user()->email)->get();


  //check the availability of bio database

  if(count($stdbio)<1)
  {

  return view('studentdashboard',['message'=>'There is no  information details in the school database that matches your email ID. Please cantact and request your class teacher to update your information details in the database']);

  }
//check if the result is for arts
  if(count($resultArts)>0)
  {

  return view('studentViews.showMyresultArtsForPDFdownload',['resultArts'=>$resultArts,'stdbio'=>$stdbio]);

  }

//check if the result if for commerece
 if(count($resultCom)>0)
  {

  return view('studentViews.showMyresultComForPDFdownload',['resultCom'=>$resultCom,'stdbio'=>$stdbio]);
}
//check if the result if for 9 and 10
  if(count($resultMiddle)>0)
  {
    return view('studentViews.showMyresultMiddleForPDFdownload',['resultMiddle'=>$resultMiddle,'stdbio'=>$stdbio]);
  }

//  check if the result if for sci
  if(count($resultSci)>0)
  {

  return view('studentViews.showMyresultSciForPDFdownload',['resultSci'=>$resultSci,'stdbio'=>$stdbio]);
  }

//check if the result if for 7 and 8
  if(count($resultLow)>0)
  {

    return view('studentViews.showMyresultLower',['resultLow'=>$resultLow]);
  }



  return view('studentdashboard',['message'=>'Result might not have been uploaded']);


}


  public function generateResultInPDF(Request $request)
     {


$std=studentuser::where('email', Auth::guard('student')->user()->email)->get('student_code');
$pathToImage ='resultScreenshot/'.$std->first()->student_code.'.png';
//dd($pathToImage);
       $cookieArray = [];
       foreach ($request->cookies as $cookieKey => $cookie) {
       $cookieArray[$cookieKey] = $cookie;
       }



//dd(base_path());

    Browsershot::url('http://localhost/screenshotDisplay')
      ->setExtraHttpHeaders(['Cookie' => http_build_query($cookieArray, null, '; ')])

        ->windowSize(1920, 1080)
        ->select('div', 1)
        ->noSandbox()
        ->save($pathToImage);

        /*$image = Browsershot::url('http://localhost/screenshotDisplay')
          ->setExtraHttpHeaders(['Cookie' => http_build_query($cookieArray, null, '; ')])
          ->setNodeBinary(base_path().'/node-v14.15.3-win-x64/node')
            ->setNpmBinary(base_path().'/node-v14.15.3-win-x64/npm')
            ->windowSize(1920, 1080)
            ->select('div', 1)

            ->screenshot();*/

/*Browsershot::html('<h1>Hello world!!</h1>')
        ->setNodeBinary(base_path().'/node-v14.15.3-win-x64/node')
        ->setNpmBinary(base_path().'/node-v14.15.3-win-x64/npm')
        ->setExtraHttpHeaders(['Cookie' => http_build_query($cookieArray, null, '; ')])
        ->usePipe()
      ->ignoreHttpsErrors()->timeout(500)->savePdf("a.pdf");*/
     }
}//closing of controller
