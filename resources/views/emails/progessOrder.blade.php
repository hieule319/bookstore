<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('public/user/assets/css/styleqrcode.css') }}">
    <link href="{{ asset('public/admin/css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h4>Thân gửi Quý khách hàng,</h4>

        <p>Quý Khách đã đặt hàng thành công</p>

        <ul style="list-style-type: none;">
            <li>Mã đơn hàng :{{ $data_mail['order_code'] }}</li>
            <li>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 1; ?>
                        @foreach($data_mail['cart'] as $product)
                        <tr>
                            <td>{{$stt}}</td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ number_format($product['product_price'], 0, '', ',') }} đ</td>
                            <td>{{ $product['product_quantity'] }}</td>
                            <td>{{ number_format(($product['product_quantity']*$product['product_price']), 0, '', ',') }} đ</td>
                        </tr>
                        <?php $stt++ ?>
                        @endforeach
                    </tbody>
                </table>
            </li>
            <li>Tổng tiền :{{ number_format($data_mail['total'], 0, '', ',') }} đ</li>
            @foreach($data_mail['address'] as $address)
            <?php if($address['city'] != null && $address['province'] != null) { ?>
                <li>Địa chỉ : {{$address['address']}}, {{$address['city']}} - {{$address['province']}} , 0{{$address['phone_delivery']}}</li>
            <?php } ?>
            <?php if($address['city'] != null) { ?>
                <li>Địa chỉ : {{$address['address']}}, {{$address['city']}}, 0{{$address['phone_delivery']}}</li>
            <?php } ?>
            <?php if($address['province'] != null) { ?>
                <li>Địa chỉ : {{$address['address']}},{{$address['province']}} , 0{{$address['phone_delivery']}}</li>
            <?php } ?>
            @endforeach
        </ul>
        <div class="qrbox">
            <h5>Quét mã này để theo dõi quá trình giao hàng</h5>
            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http://bookstoreproject.online/progress-order/{{$data_mail['order_code']}}" alt="qr-code">
        </div>
        <p>Mọi thông tin chi tiết hỗ trợ vui lòng liên hệ:</p>

        <ul style="list-style-type: none;">
            <li>Hotline: <a href="tel:0888537087">0888537087</a></li>
            <li>Email: <a href="mailto:hieulev319@gmail.com">hieulev319@gmail.com</a> </li>
            <li>Website: <a href="#">Bookstore</a></li>
            <li>Facebook: <a href="https://www.facebook.com/profile.php?id=100004021754013">https://www.facebook.com/profile.php?id=100004021754013</a></li>
        </ul>

        <p>Trân trọng,<br>
        <figcaption class="blockquote-footer">
            Bookstore – Thế giới sách
        </figcaption>
        </p>

    </div>


</body>

</html>