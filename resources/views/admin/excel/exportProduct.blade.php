<table class="table">
    <thead>
        <tr>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Tên sản phẩm</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Mã sản phẩm</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Giá gốc</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Số lượng</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Tổng giá</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_name }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_qrcode	}}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_price }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_quantity }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial"></td>
        </tr>
        @endforeach
    </tbody>
</table>