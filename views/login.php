<div style="width:400px;text-align: center;margin-left: auto;margin-right: auto;">
<form name="login" method="post" action="index.php?controller=login">    
    <h3>Форма авторизации</h3>
    <h5>Введите логин и пароль</h5>
    
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width: 90px;">ЛОГИН</span>
        </div>
        <input name="login" type="text" class="form-control" placeholder="введите логин" aria-describedby="basic-addon1" value="<?=(isset($this->DATA['user_name'])?$this->DATA['user_name']:'')?>">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width: 90px;">ПАРОЛЬ</span>
        </div>
        <input name="password" type="password" class="form-control" placeholder="введите пароль" aria-describedby="basic-addon1" value="<?=(isset($this->DATA['user_name'])?$this->DATA['user_name']:'')?>">
    </div>
    <input class="btn btn-outline-primary" type="submit" value="Вход">
    <input name="n_page" type="text" style="display:none" value="<?=$this->DATA['n_page'];?>">
    <input name="sort_name" type="text" style="display:none" value="<?=$this->DATA['sort_name'];?>">
    <input name="sort_dir" type="text" style="display:none" value="<?=$this->DATA['sort_dir'];?>">
</form>
</div>
<?if ($this->DATA['error']) echo "<script>alert('".$this->DATA['error_message']."');</script>";?>
