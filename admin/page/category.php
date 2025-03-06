<form action="" method="post" class="m-4" >
<div class="card m-4 shadow">
                <div class="card-header h4 bold">Danh mục: </div> 
                <div class="card-body flex"> 
                    <div class="card-body d-flex">
                        <?php
                            category_list();
                        ?>
                    </div>
                    <div class="card-body width-3">
                        <form action="" method="post">
                            <input type="text" class="form-control" name="category"> 
                            </br>
                            <input type="submit" class="btn btn-primary" name="add_category" value="Thêm danh mục">
                        </form>
                    </div>
                </div>
            </div>
</form>