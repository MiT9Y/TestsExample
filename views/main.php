<style>
    .table-hover-head:hover {
      background-color: gainsboro;
    }
    #listT th, #listT td {
        vertical-align: middle;
    }
</style>
<script>
    function change_sort(self){
        sort_name_el = self.getAttribute("sort");
        if (sort_name_el!=sort_name) sort_name = sort_name_el; 
            else if (sort_dir == 0) sort_dir = 1; else sort_dir = 0;
        reload_page('index.php',{n_page:n_page,sort_name:sort_name,sort_dir:sort_dir});
    }
    function select_line(self){
      select_row = document.getElementById('select_row_list');
      if (select_row!=null) {
        select_row.removeAttribute("style");
        select_row.removeAttribute("id");
      }
      self.setAttribute("id","select_row_list");
      self.setAttribute("style","background-color:gainsboro");
      id_list = self.getAttribute("id_list");
    }
</script>

<div style="margin: 15px;">  
<h3>Список задач</h3>
<table id="listT" class="table table-hover table-bordered" style="cursor: pointer;">
  <thead>
    <tr>
      <th sort = "user" class="table-hover-head" onclick="change_sort(this);">
        <?if ($this->DATA['sort']['name']=='user'){
            if ($this->DATA['sort']['dir']==0) echo '▲ '; else echo '▼ ';
        }?>имя пользователя</th>
      <th sort = "email" class="table-hover-head" onclick="change_sort(this);">
        <?if ($this->DATA['sort']['name']=='email'){
            if ($this->DATA['sort']['dir']==0) echo '▲ '; else echo '▼ ';
        }?>email</th>
      <th>текст задачи</th>
      <th sort = "status" style="width: 100px;" class="table-hover-head" onclick="change_sort(this);">
        <?if ($this->DATA['sort']['name']=='status'){
            if ($this->DATA['sort']['dir']==0) echo '▲ '; else echo '▼ ';
        }?>статус</th>
    </tr>
  </thead>
  <tbody>
    <?if ($this->DATA['c_page']>0) foreach ($this->DATA['list'] as $key => $value) {?>
    <tr id_list="<?=$value[0]?>" onclick="select_line(this);">
      <td><pre><?=prepare_text($value[1])?></pre></td>
      <td><pre><?=prepare_text($value[2])?></pre></td>
      <td><pre><?=prepare_text($value[3])?></pre></td>
      <td><?=(($value[4]==1)?"выполнено":"").(($value[4]==1&&$value[5]==1)?", ":"").(($value[5]==1)?"отредактировано администратором":"")?></td>
    </tr>
    <?}?>
  </tbody>
</table>
</div>

<div role="group" aria-label="Basic example" class="btn-group" style="margin-left: 15px;">
<?if ($_SESSION['isAdmin']==1) {?>
    <button type="button" class="btn btn-outline-primary" onclick="reload_page('index.php',{controller:'add_edit',act:'edit',id:id_list,n_page:n_page,sort_name:sort_name,sort_dir:sort_dir});">редактировать</button>
    <button type="button" class="btn btn-outline-primary" onclick="reload_page('index.php',{controller:'add_edit',act:'del',id:id_list,n_page:n_page,sort_name:sort_name,sort_dir:sort_dir});">удалить</button>
<?} else {?>
    <button type="button" class="btn btn-outline-primary" onclick="reload_page('index.php',{controller:'add_edit',act:'add',id:id_list,n_page:n_page,sort_name:sort_name,sort_dir:sort_dir});">добавить</button>
<?}?>
</div>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?for ($p = 1; $p <= $this->DATA["c_page"]; $p++) {?>
            <li class="page-item <?=(($p==$this->DATA["n_page"])?"active":"")?>"><a class="page-link" href="index.php?n_page=<?=$p?>&sort_name=<?=$this->DATA['sort']['name']?>&sort_dir=<?=$this->DATA['sort']['dir']?>"><?=$p?></a></li>
        <?}?>
  </ul>
</nav>

<?if ($this->DATA['message']) echo "<script>alert('".$this->DATA['message']."');</script>"?>