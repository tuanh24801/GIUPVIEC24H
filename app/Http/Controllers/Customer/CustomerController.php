<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use Carbon\Carbon;


class CustomerController extends Controller
{
    public $vnp_TmnCode = "2EXE1VOI"; //Mã định danh merchant kết nối (Terminal Id)
    public $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    public $vnp_HashSecret = "NCCKOMUNIMIBORJBFINSUIRTBYGOUMWX"; //Secret key
    public $vnp_Returnurl = "https://damvinkorean.com/vnpay_php/vnpay_return.php";
    public $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
    public $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6|max:15',
            'cpassword' => 'required|same:password',
        ],[
            'cpassword.same' => 'The confirm password and password must match'
        ]);

        $user = new Customer();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $data = $user->save();
        if($data){
            return back()->with('success', 'User created successfully');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    public function doLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::guard('customer')->attempt($request->only('email', 'password'))){
            return redirect()->route('home');
            // return 'ddawng nhap ok';
        }else{
            return back()->with('error', 'Something went wrong');
        }
        // return 'asdasf';
    }

    public function logout(Request $request){
        // dd($request->guard());
        Auth::guard('customer')->logout();
        return redirect()->route('home');
    }

    public function profile(Request $request){
        $jobs = Job::where('status', 1)->get();
        return view('customer.profile', ['jobs' => $jobs]);
    }

    public function update(Request $request){
        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
        ];
        $messages = [
            'name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'address.required' => 'Địa chỉ khách hàng bắt buộc phải nhập',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.digits' => 'Sai độ dài vui lòng nhập đúng số điện thoại',
        ];

        $request->validate($rules,$messages);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

        if($request->has('password')){
            $rules = array_merge($rules, [
                'password' => 'required|min:6',
                'cpassword' => 'required|same:password',
            ]);
            $messages = array_merge($messages, [
                'password.required' => 'Mật khẩu bắt buộc phải nhập',
                'password.min' => 'Vui lòng nhập lớn hơn :min ký tự',
                'cpassword.required' => 'Vui lòng xác nhận mật khẩu',
                'cpassword.same' => 'Xác nhận mật khẩu không khớp',
            ]);

            // $errand_worker->password = Hash::make($request->password);
            $customer->password = $request->password;
        }

        $request->validate($rules,$messages);

        if($request->has('avatar')){
            $rules = array_merge($rules, [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $messages = array_merge($messages,[
                'avatar.image' => 'Vui lòng chọn đúng định dạng ảnh',
                'avatar.max' => 'Kích thước file ảnh tối đa là :max mb',
            ]);
            if(!empty($request->avatar)){
                $fileName = time() . '.' . $request->avatar->extension();
                $request->file('avatar')->storeAs('public/images/customer-images', $fileName);
                $customer->avatar = $fileName;
            }
        }

        if($request->has('email')){
            return redirect()->back()->withErrors(['email' => 'Không được thay đổi Email đăng nhập']);
        }

        $request->validate($rules,$messages);
        $customer->save();
        return redirect()->back()->with('msg','Cập nhật thông tin người làm việc thành công !');
    }

    public function pay(){
        return view('customer.vn_pay.pay');
    }

    public function create_payment(Request $request){

        $rules = [
            'amount' => 'required|numeric|between:10000,10000000'
        ];

        $messages = [
            'amount.required' => 'Vui lòng nhập số tiền',
            'amount.numeric' => 'Vui lòng nhập đúng định dạng',
            'amount.between' => 'Vui lòng nhập trong khoảng 10.000 - 10.000.000 (vnđ)',
        ];

        $request->validate($rules, $messages);

        $vnp_TxnRef = rand(1,10000); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount =  $request->amount; // Số tiền thanh toán
        $vnp_BankCode = $request->bankCode;
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_TmnCode = "2EXE1VOI"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "NCCKOMUNIMIBORJBFINSUIRTBYGOUMWX"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('customer.return');
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire
        );
        if(isset($request->bankCode) && $request->bankCode != ''){
            $inputData['vnp_BankCode'] = $request->bankCode;
        }
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
        header('Location: ' . $vnp_Url);
        die();
    }

    public function return(Request $request){
        $info_vnpay_return = $request->all();
        $vnp_HashSecret = "NCCKOMUNIMIBORJBFINSUIRTBYGOUMWX";
        // $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($info_vnpay_return as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        // dd($inputData);

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash_ = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $amount = $request->vnp_Amount;
        // $bankCode = $request->vnp_BankCode;
        // $cardType = $request->vnp_CardType;
        // $orderInfo = $request->vnp_OrderInfo;
        // $payDate = $request->vnp_PayDate;
        // $responseCode = $request->vnp_ResponseCode;
        // $tmnCode = $request->vnp_TmnCode;
        // $transactionNo = $request->vnp_TransactionNo;
        // $transactionStatus = $request->vnp_TransactionStatus;
        // $txnRef = $request->vnp_TxnRef;
        // $secureHash = $request->vnp_SecureHash;
        // $info_vnpay_return = $request->all();

        // Ngân hàng	NCB
        // Số thẻ	9704198526191432198
        // Tên chủ thẻ	NGUYEN VAN A
        // Ngày phát hành	07/15
        // Mật khẩu OTP	123456

        if ($secureHash_ == $request->vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $status = 'success';
                $msg = 'Giao dịch thành công';

            } else {
                $status = 'danger';
                $msg = 'Giao dịch không thành công';
            }
        } else {
            $status = 'danger';
            $msg = 'Lỗi chữ ký không hợp lệ';
        }

        return view('customer.vn_pay.return', [ 'status' =>$status, 'msg' => $msg,'amount' => $amount]);
    }
}
