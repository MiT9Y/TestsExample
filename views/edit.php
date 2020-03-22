<div style="width:500px;text-align: center;margin-left: auto;margin-right: auto;">
<h3>Форма добавления/редактирования задачи</h3>
<form name="edit" method="post" action="index.php?controller=add_edit&act=<?=$this->DATA['act']?>&id=<?=$this->DATA['id']?>" id_list = <?=$this->DATA['id']?>>
    <?if ($_SESSION['isAdmin']==1) {?>
        <br><div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Текст задачи</span>
            </div>
            <textarea class="form-control" name="comment"><?=(isset($this->DATA['comment'])?$this->DATA['comment']:'')?></textarea>
        </div>
        <div class="custom-control custom-checkbox mr-sm-2" style="text-align: left;margin-top: 10px;margin-bottom: 15px;">
            <input name="completed" type="checkbox" class="custom-control-input" id="customControlAutosizing" <?=(($this->DATA['completed']==1)?'checked':'')?>>
            <label class="custom-control-label" for="customControlAutosizing">Задача выполнена</label>
        </div>
        <!--<p><b>задача выполнена:</b> <input name="completed" type="checkbox" <?=(($this->DATA['completed']==1)?'checked':'')?>></p>-->
    <?} else {?>
        <br>
        <div class="form-row">
            <div class="col">
                <input name="name" type="text" class="form-control" placeholder="Имя пользователя" value="<?=(isset($this->DATA['name'])?$this->DATA['name']:'')?>">
            </div>
            <div class="col">
                <input name="email" type="text" class="form-control" placeholder="Email пользователя" value="<?=(isset($this->DATA['email'])?$this->DATA['email']:'')?>">
            </div>
        </div><br>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Текст задачи</span>
            </div>
            <textarea class="form-control" name="comment"><?=(isset($this->DATA['comment'])?$this->DATA['comment']:'')?></textarea>
        </div><br>
    <?}?>
    <input class="btn btn-outline-primary" type="submit" value="сохранить">
    <input name="n_page" type="text" style="display:none" value="<?=$this->DATA['n_page'];?>">
    <input name="sort_name" type="text" style="display:none" value="<?=$this->DATA['sort_name'];?>">
    <input name="sort_dir" type="text" style="display:none" value="<?=$this->DATA['sort_dir'];?>">
</form>
</div>
<?if ($this->DATA['message']) echo "<script>alert('".$this->DATA['message']."');</script>"?>