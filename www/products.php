<?php
require_once '../config.php';
?>
<html>
  <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="starter-template.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </head>
  <body>
      <!-- <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Home</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/products.php?products">products</a></li>
          </ul>
        </div><!--/.nav-collapse -->
    <!--  </div>
    </nav> -->

    <div class="container">

      <div class="starter-template">
          
          <div class="row">
<?php

$prod_ids = dbLink::getDB()->selectCol('select id from products where 1');
$prods = array();
foreach ($prod_ids as $id)
{
    $prods[$id] = new Model_Product($id);
    $prods[$id]->fillIngredients();
}
$prods_list_html = "";
$prod_table_html = "<div class='row'><div class='col-md-4'>продукт</div><div class='col-md-2'>реф.уровень.</div><div class='col-md-2'>минуты</div><div class='col-md-2'>цена единицы</div><div class='col-md-2'>партия</div>";
foreach ($prods as $prod)
{
    $prods_list_html .="<div>".$prod->getLinkHelper()."</div>";
    $prod_table_html .="<div class='col-md-4'>{$prod->getLinkHelper()}</div>";
    $prod_table_html .="<div class='col-md-2'>{$prod->base_level}</div>";
    $prod_table_html .="<div class='col-md-2'>{$prod->minutes}</div>";
    $prod_table_html .="<div class='col-md-2'>{$prod->price}</div>";
    $prod_table_html .="<div class='col-md-2'>{$prod->base_amount}</div>";
}
$prod_table_html.="</div>";
$prod_structure_html = "";
$prod_all_ingridients_html = "";
if (isset($_GET['p']))
{
    $product = $prods[$_GET['p']];
    $prod_structure_html = $product->getPrinted();
    $allIngredients = $product->getAllIngredientsAsArray();
    foreach ($allIngredients as $ingr)
    {
        $prod_all_ingridients_html.= "<div>{$ingr['p']->getLinkHelper()} - {$ingr['q']}</div>";
    }
    $progress = array();
//    $progress[$product->base_level] = array('amount'=>$product->base_amount, 'addval'=>$product->getAddValue());
//    foreach ($product->ingredients as $ingr) /* @var $ingr Model_Product */
//    {
//        $progress[$product->base_level]['ings'][$ingr->id] = $ingr->base_quantity;
//    }
    for ($i=0;$i<=20;$i++)
    {
        if ($i == $product->base_level)
        {
            $current_prod = $product;
        } else {
            $current_prod = new Model_Product($product->id);
            $current_prod->fillIngredients();
            $current_prod->modifyProductToProdLevel($product, $i);
        }
        $progress[$i] = array('amount'=>$current_prod->base_amount, 'addval'=>$current_prod->getAddValue());
        foreach ($current_prod->ingredients as $ingr) /* @var $ingr Model_Product */
        {
            $progress[$i]['ings'][$ingr->id] = $ingr->base_quantity;
        }
    }
    $prod_progress_html = "";
    $prod_progress_html[-1] = "<div class='col-md-2'>level</div><div class='col-md-2'>amount</div>";
    foreach ($product->ingredients as $ing)
    {
        $prod_progress_html[-1] .= "<div class='col-md-2'>{$ing->name}</div>"; 
    }
    $prod_progress_html[-1] .= "<div class='col-md-2'>add.val.</div>";
    foreach ($progress as $level=>$level_data)
    {
        $prod_progress_html[$level] = "<div class='col-md-2'>{$level}</div><div class='col-md-2 bg-warning'>{$level_data['amount']}</div>";
        if (isset($level_data['ings']))
        foreach ($level_data['ings'] as $ing_count)
        {
            $prod_progress_html[$level].= "<div class='col-md-2'>{$ing_count}</div>";
        }
        $prod_progress_html[$level] .= "<div class='col-md-2'>{$level_data['addval']}</div>";
    }
}
if (!isset($product))
{
    echo "<div class='col-md-12'>продукты ";
?>
<form class="form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="datetimefield">date time</label>
    <input type="datetime" class="form-control" id="datetimefield" placeholder="YYYY-MM-DD H:i:s" />
  </div>
  <button type="submit" class="btn btn-default">что изменилось?</button>
</form>
<?php
    echo $prod_table_html;
    echo "<div class='col-md-10'>";
    echo "<div class='row'>";
}
if (isset($product))
{
    echo "<div class='col-md-2'><p><a href='/products.php'>список продуктов</a></p>";
    echo $prods_list_html;
    echo "</div>";
    echo "<div class='col-md-10'>";
    echo "<div class='row'>";
    echo "<div class='col-md-6'><h2>{$product->name} ({$product->code})</h2>";
    echo $prod_structure_html;
    echo "</div>";
    echo "<div class='col-md-6'>Расчет количества ресурсов на партию для референсных уровней:";
    echo $prod_all_ingridients_html;
    echo "</div></div>";
    echo "<div class'row'>";
    echo "<div class='col-md-12'><h3>производительность</h3>";
    foreach ($prod_progress_html as $level=>$progress_line)
    {
        $color = "";
        if ($level == $product->base_level)
            $color = ' bg-success';
        echo "<div class='row{$color}'>{$progress_line}</div>";
    }
    echo "</div></div>";
}
?>
     </div>

    </div>
  </body>
</html>