<main role="main">
    <div class="form_add_cat">
    <div class="title_cat">
    <h3>
            Thêm danh mục
        </h3>
    </div>
          
      <form action="index.php?act=category_form_add" class="add_cate" method="post">
       <div class="select_cat">
       <label for="select_input_cate">Cấp danh mục :</label>
        <select name="select_input_cate" id="select_input_cate">
            <option value="0">cao nhất</option>
        <?php $cat_tree = $cat->list_categories();
           if(!empty($cat_tree)){
            $cat->show_cat_select_box($cat_tree,0);
           }
           ?>
        </select>
        </div>
        <div class="cat_menu">
           <label for="">
           Tên danh mục
        <input type="text" name="category_name" id="" required>   
        </label>
        </div>
        <input type="submit" value="gửi">
      </form>
      </div>
</main>
<style>
    .title_cat{
        text-align: center;
    }
    .add_cate{
        margin: 0 auto;
        text-align: center;
        width: 80%;
    }
    .select_cat{
        display: flex;
        justify-content: center;
        height: 30px;
        margin-top: 20px;
        align-items: center;
    }
    .select_cat label{
        margin: 0;
    }
    .cat_menu input{
        display: inline;
        padding: 0.5em;
         width: 30%;
         margin: 0 5px;
    }
    #select_input_cate{
         padding: 5px;
         width: 30%;
         margin: 0 5px;
    }
</style>