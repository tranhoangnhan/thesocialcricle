<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentModel;
use App\Models\CoursesModel;
use App\Models\EnrollmentModel;
use App\Mail\InvoicePaid;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function payment_vnpay() {
        return view('payment_vnpay');
    }
    public function checkCourse() {
        $course = CoursesModel::where('slug', request()->slug)->first();
        $amount = $course->amount;
        return $amount;
    }
    public function payment_vnpay__(Request $request) {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = env('APP_URL') . "/courses/$request->slug/checkout/callback";
$vnp_TmnCode = "0ULJSLFK";//Mã website tại VNPAY 
$vnp_HashSecret = "YJINARQZKQXZALFRGWLPCFPGGFZHHVOR"; //Chuỗi bí mật
$vnp_TxnRef = date('YmdHis'); //Mã đơn hàng
$user = auth()->user()->user_id;
$vnp_OrderInfo ="User $user  Thanh toan khoa hoc $request->slug  ";
$vnp_OrderType = 'billpayment';
$vnp_Amount = $this->checkCourse() * 100;
$vnp_Locale = 'vn';
$vnp_BankCode = '';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
// $vnp_ExpireDate = $_POST['txtexpire'];
//Billing
// $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
// $vnp_Bill_Email = $_POST['txt_billing_email'];
// $fullName = trim($_POST['txt_billing_fullname']);
// if (isset($fullName) && trim($fullName) != '') {
//     $name = explode(' ', $fullName);
//     $vnp_Bill_FirstName = array_shift($name);
//     $vnp_Bill_LastName = array_pop($name);
// }
// $vnp_Bill_Address=$_POST['txt_inv_addr1'];
// $vnp_Bill_City=$_POST['txt_bill_city'];
// $vnp_Bill_Country=$_POST['txt_bill_country'];
// $vnp_Bill_State=$_POST['txt_bill_state'];
// // Invoice
// $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
// $vnp_Inv_Email=$_POST['txt_inv_email'];
// $vnp_Inv_Customer=$_POST['txt_inv_customer'];
// $vnp_Inv_Address=$_POST['txt_inv_addr1'];
// $vnp_Inv_Company=$_POST['txt_inv_company'];
// $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
// $vnp_Inv_Type=$_POST['cbo_inv_type'];
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    // "vnp_ExpireDate"=>$vnp_ExpireDate,
    // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
    // "vnp_Bill_Email"=>$vnp_Bill_Email,
    // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
    // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
    // "vnp_Bill_Address"=>$vnp_Bill_Address,
    // "vnp_Bill_City"=>$vnp_Bill_City,
    // "vnp_Bill_Country"=>$vnp_Bill_Country,
    // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
    // "vnp_Inv_Email"=>$vnp_Inv_Email,
    // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
    // "vnp_Inv_Address"=>$vnp_Inv_Address,
    // "vnp_Inv_Company"=>$vnp_Inv_Company,
    // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
    // "vnp_Inv_Type"=>$vnp_Inv_Type
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
}

//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00'
    , 'message' => 'success'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        return redirect($vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
	// vui lòng tham khảo thêm tại code demo
    }

    public function insert_db(Request $request) {
        if($request->vnp_ResponseCode == "00") {

        PaymentModel::create(
            [
                'vnp_TxnRef' => request()->vnp_TxnRef,
                'vnp_OrderInfo' => request()->vnp_OrderInfo,
                'vnp_Amount' => request()->vnp_Amount / 100,
                'vnp_ResponseCode' => request()->vnp_ResponseCode,
                'user_id' => auth()->user()->user_id,
                'course_id' => CoursesModel::where('slug', request()->slug)->first()->course_id
            ]
            );
        EnrollmentModel::create([
            'user_id' => auth()->user()->user_id,
            'course_id' => CoursesModel::where('slug', request()->slug)->first()->course_id
        ]);
$amount = request()->vnp_Amount / 100;
$course = CoursesModel::where('slug', request()->slug)->first();
$date = date('Y-m-d H:i:s');
$id_bill = request()->vnp_TxnRef;

$courseLink =  env('APP_URL') . "/courses/$request->slug/";
Mail::to(auth()->user()->user_email)->send(new InvoicePaid($amount, $course, $date, $id_bill, $courseLink));
        return redirect('/courses/' . request()->slug . '/');
        
    }
    else {
        return redirect('/courses/' . request()->slug);
    }
}

}
