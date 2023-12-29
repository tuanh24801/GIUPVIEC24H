
@guest('customer')
    Trang chủ<br>
    Bạn có thể: <br>
    <a href="{{ route('customer.login') }}">Đăng nhập</a><br>
    <a href="{{ route('customer.register') }}">Đăng ký</a>
@else
    Tên: {{ Auth::guard('customer')->user()->name }}
    <a href="{{ route('customer.logout') }}">Đăng xuất</a>
@endguest

