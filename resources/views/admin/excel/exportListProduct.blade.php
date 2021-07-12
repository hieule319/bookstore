<table class="table">
    <thead>
        <tr>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Tên sản phẩm</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Mã sản phẩm</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Giá gốc</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Giá bán</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Giá sale</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Số lượng</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Mô tả</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Đơn vị tính</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Danh mục</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Thể loại</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Tác giả</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Nhà xuất bản</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Năm xuất bản</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Ảnh</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Ảnh 1</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Ảnh 2</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Ảnh 3</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Ảnh 4</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Ảnh 5</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Slug</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Ngôn ngữ</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Số trang</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Kích thước</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Trọng lượng</th>
            <th style="color:aliceblue;font-size:14px;background-color:darkgreen;font-family:Arial">Trang thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_name }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_qrcode	}}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_price }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_sell }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_sale }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_quantity	}}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_description }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_unit }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->category_id }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->category_detail_id}}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->author }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->publisher_id }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->publishing_year }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->thumbnail	}}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->thumbnail1 }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->thumbnail2 }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->thumbnail3 }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->thumbnail4}}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->thumbnail5 }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->slug }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_language }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_pages	}}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_dimensions }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->product_weight }}</td>
            <td style="font-size:12px;width: 40px;font-family:Arial">{{ $product->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>