
<main role="main">
<div class="container-form-add">
        <form  action="index.php?act=product_form_add" id="productForm"  method="post" enctype="multipart/form-data">
            <h2>Thêm sản phẩm</h2>           
            <input type="text" id="productName" name="productName" placeholder="Nhập tên sản phẩm">
            <input type="text" name="price" placeholder="Giá" >
            <textarea id="productDescription" name="productDescription" placeholder="Mô tả" rows="4"></textarea>
            <label for="">Giảm giá sản phẩm</label>
            <select name="sale_select" id="saleSelect">
                <option value="1">Có</option>
                <option selected value="0">Không</option>
            </select>
            <div id="salePriceContainer" style="display: none;">
                <input type="text" placeholder="Giá sale" name="sale_price" id="salePrice">
            </div>
            <label for="">Ảnh đại diện</label>
            <input type="file" name="image" accept="image/*">
            <label for=""> ảnh liên quan</label>
            <input type="file" name="files[]" accept="image/*" multiple>
            <label for="">Hãng sản xuất</label>
            <select name="category_id" id="">
            <?php $cat_tree = $cat->list_categories();
           if(!empty($cat_tree)){
            $cat->show_cat_select_box($cat_tree,0);
           }
           ?>
            </select>
            <input type="submit">
        </form>
    </div>
    
</main>
    <style>
.container-form-add {
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
    max-width: 400px;
    margin: 0 auto;
}

h2 {
    text-align: center;
    color: #3498db;
}

label {
    margin-top: 10px;
    font-size: 14px;
    color: #333;
}

input, textarea {
    padding: 10px;
    margin: 5px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #217dbb;
}

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Lắng nghe sự kiện thay đổi giá trị của select
            document.getElementById("saleSelect").addEventListener("change", function () {
                // Hiển thị hoặc ẩn input Giá Sale tùy thuộc vào giá trị của select
                var salePriceContainer = document.getElementById("salePriceContainer");
                var salePriceInput = document.getElementById("salePrice");

                if (this.value == 0) {
                    salePriceContainer.style.display = "none";
                    salePriceInput.required = false;
                } else {
                    salePriceContainer.style.display = "block";
                    salePriceInput.required = true; 
                }
            });
            document.getElementById("saleSelect").dispatchEvent(new Event("change"));
        });
    </script>