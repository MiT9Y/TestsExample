<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
	<title>Тестовая задача</title>
</head>
<body>
    <script>
        function reload_page(url,parameters){
            var arr = Object.keys(parameters);
            if (arr.length >0) url += '?';
            arr.forEach(function(p_name) {
                url += p_name+'='+parameters[p_name]+'&';
            });
            location.href = url;
        }
    </script>

    <script>
        var id_list='';
        var n_page = '<?=$this->DATA["n_page"]?>';
        var sort_name = '<?=$this->DATA['sort']['name']?>';
        var sort_dir = '<?=$this->DATA['sort']['dir']?>';
    </script>

<div style="margin: 15px;">
<table style="width: 100%;"><tbody><tr><td>
    <?if (isset($_SESSION['user'])) {?>
        <H5>Здравствуйте, <?=(($_SESSION['isAdmin']==1) ? "администратор " : "пользователь ").$_SESSION['user']?></H5>
    <?}else {?>
        <H5>Здравствуйте, гость</H5>
    <?}?>
</td><td style="text-align: right;">
    <div role="group" aria-label="Basic example" class="btn-group">
        <button type="button" class="btn btn-outline-primary" onclick="reload_page('index.php',{n_page:n_page,sort_name:sort_name,sort_dir:sort_dir});">ГЛАВНАЯ СТРАНИЦА</button>
        <?if (isset($_SESSION['user'])) {?>
            <button type="button" class="btn btn-outline-primary"onclick="reload_page('index.php',{controller:'login',exit:1,n_page:n_page,sort_name:sort_name,sort_dir:sort_dir});">ВЫЙТИ</button>
        <?}else {?>   
            <button type="button" class="btn btn-outline-primary"onclick="reload_page('index.php',{controller:'login',n_page:n_page,sort_name:sort_name,sort_dir:sort_dir});">АВТОРИЗАЦИЯ</button>
        <?}?>    
    </div>
</td></tr></tbody></table>
</div>

    <?php if (file_exists('views/'.$this->view)) include 'views/'.$this->view;?>
</body>
</html>