<main role="main">
    <div class="form_add_cat">
        <div class="title_cat">
            <h3>Cập nhật danh mục</h3>
        </div>

        <?php
        $id_cat = isset($_GET["id"]) ? $_GET["id"] : '';
        $catemodel = new CategoriesModel();
        $category = $catemodel->get_category_by_id($id_cat);

        ?>

        <form action="index.php?act=update_category&id=<?= $id_cat ?>" class="add_cate" method="post">
            <div class="select_cat">
                <label for="select_input_cate">Cấp danh mục :</label>
                <select name="select_input_cate" id="select_input_cate">
                    <option value="0" <?= ($category['parent_id'] == 0) ? 'selected' : '' ?>>Cao nhất</option>
                    <?php
                    $cat_tree = $cat->list_categories();
                    if (!empty($cat_tree)) {
                        foreach ($cat_tree as $cat_item) {
                            $selected = ($cat_item['category_id'] == $category['parent_id']) ? 'selected' : '';
                            echo "<option value='{$cat_item['category_id']}' $selected>{$cat_item['category_name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="cat_menu">
                <label>
                    Tên danh mục
                    <input type="text" name="category_name" value="<?= isset($category['category_name']) ? htmlspecialchars($category['category_name']) : '' ?>">

                </label>
            </div>
            <input type="submit" value="Cập nhật">
        </form>
    </div>
</main>

<style>
    .title_cat {
        text-align: center;
    }

    .add_cate {
        margin: 0 auto;
        text-align: center;
        width: 80%;
    }

    .select_cat {
        display: flex;
        justify-content: center;
        height: 30px;
        margin-top: 20px;
        align-items: center;
    }

    .select_cat label {
        margin: 0;
    }

    .cat_menu input {
        display: inline;
        padding: 0.5em;
        width: 30%;
        margin: 0 5px;
    }

    #select_input_cate {
        padding: 5px;
        width: 30%;
        margin: 0 5px;
    }
</style>