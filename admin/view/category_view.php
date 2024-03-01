<main role="main">
    <div class="box_search">
        <div class="flex_1">
        </div>
        <div class="flex2">
            <a href="index.php?act=add_categories">Thêm</a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="payment-order clearfix">
            <h1>Danh mục</h1>
            <table class="table">
                <thead>
                    <td>id</td>
                    <td>Tên danh mục</td>
                    <td><a href="">sửa</a></td>
                    <td><a href="">xóa</a></td>
                    </tr>
                </thead>

                <tbody>




                    <?php

                    $cat_tree = $cat->list_categories();


                    if (!empty($cat_tree)) {
                        $cat->show_cat_admin($cat_tree, 0);
                    }   ?>



                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</main>
<style>
    .box_search {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-around;
    }

    .flex_1 {
        flex: 1;
        margin: 0 120px;
    }

    .flex2 a {
        background-color: #ccc;
        display: inline-block;
        text-decoration: none;
        color: white;
        padding: 10px;
    }

    .flex2 {
        float: right;
        margin: 0 130px;
    }
</style>
<script>
    function category_delete(id) {
        if (confirm("Bạn có muốn xóa danh mục?")) {
            window.location.href = "index.php?act=delete_category&id=" + id;
        }
    }
</script>
<!-- Các thẻ khác ... -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>