<?php
class Model_Product extends Model_Abstract{
    
    public $id;
    public $name;
    public $minutes;
    public $price_one;
    public $base_amount;
    public $base_level;
    public $price;
    public $building_id;
    public $base_quantity = 1;
    public $ingredients = array();
    public $is_food;
    protected $_tablename = 'mi_products';
    
    protected $_allIngredients =  null;
    
    public function __construct($object_id) {
        parent::__construct($object_id);
        $this->base_quantity = $this->base_amount;
    }


    public function fillIngredients()
    {
        $ingredients_data = $this->_db()->select('select ingredient_id, base_quantity from mi_prod_content where prod_id=?d', $this->id);
        foreach ($ingredients_data as $ing)
        {
            $this->ingredients[$ing['ingredient_id']] = new Model_Product($ing['ingredient_id']);
            $this->ingredients[$ing['ingredient_id']]->base_quantity = $ing['base_quantity'];
            $this->ingredients[$ing['ingredient_id']]->fillIngredients();
        }
    }
    
    public function getLinkHelper()
    {
        return "<a href=\"/products.php?p={$this->id}\">{$this->name}</a>";
    }
    
    public function getAllIngredientsAsArray(&$products = array(), $pquantity = 1, $first_call = true)
    {
        if (is_null($this->_allIngredients))
        {
            if (!isset($products[$this->id]))
            {
                $products[$this->id]['p'] = $this;
                $products[$this->id]['q'] = $this->base_quantity * $pquantity;
            }
            else {
                $products[$this->id]['q']+=$this->base_quantity * $pquantity;
            }
            foreach ($this->ingredients as $ingr)
            {
                $ingr->getAllIngredientsAsArray($products, $this->base_quantity/$this->base_amount * $pquantity, false);
            }
            if ($first_call)
                $this->_allIngredients = $products;
        }
        return $this->_allIngredients;
    }
    
    public function getPrinted()
    {
        $html = $this->getLinkHelper();
        if (isset($this->ingredients))
        {
            $html.= "<ul>";
            foreach ($this->ingredients as $ingredient)
            {
                $html.= "<li>[{$ingredient->base_quantity}] ".$ingredient->getPrinted()."</li>";
            }
            $html.= "</ul>";
        }
        return $html;
    }
    
    public function getAddValue()
    {
        $ing_value = 0;
        foreach ($this->ingredients as $ing)
        {
            $ing_value += $ing->price_one * $ing->base_quantity;
        }
        return $this->price_one * $this->base_amount - $ing_value;
    }
    
    public function modifyProductToProdLevel(Model_Product $base_product, $target_level)
    {
        if ($target_level > $base_product->base_level)
        {
            if (false)//($this->is_food)
            {
//                for ($i=$base_product->base_level+1;$i<=$target_level;$i++)
//                {
//                    $effect1 = $this->tryToReduceIng($base_product,1,0);
//                    $effect2 = $this->tryToReduceIng($base_product,1,1);
//                    $effect3 = $this->tryToReduceIng($base_product,1,2);
//                    $effect4 = $this->tryToIncreaseAmount($base_product);
//                    $min = false;
//                    $what = array();
//                    $profit_lowlimit = 1.05;
//                    $quantity = 0;
//                    do
//                    {
//                        $quantity++;
//                        $effect1 = $this->tryToReduceIng($base_product,$quantity,0);
//                    } while ($effect1 !== false && $effect1['effect']<$profit_lowlimit);
//                    if ($effect1)    
//                        if (!$min || $effect1['effect']<$min)
//                        {
//                            $min = $effect1['effect'];
//                            $what = array('todo'=>'reduceIngr', 'ingr_id'=>$effect1['ingr'], 'quantity'=>$quantity);
//                        }
//                    $quantity = 0;
//                    do
//                    {
//                        $quantity++;
//                        $effect2 = $this->tryToReduceIng($base_product,$quantity,1);
//                    } while ($effect2 !== false && $effect2['effect']<$profit_lowlimit);
//                    if ($effect2)
//                        if (!$min || $effect2['effect']<$min)
//                        {
//                            $min = $effect2['effect'];
//                            $what = array('todo'=>'reduceIngr', 'ingr_id'=>$effect2['ingr'], 'quantity'=>$quantity);
//                        }
//                    $quantity = 0;
//                    do
//                    {
//                        $quantity++;
//                        $effect3 = $this->tryToReduceIng($base_product,$quantity,2);
//                    } while ($effect3 !== false && $effect3['effect']<$profit_lowlimit);
//                    if ($effect3)
//                        if (!$min || $effect3['effect']<$min)
//                        {
//                            $min = $effect3['effect'];
//                            $what = array('todo'=>'reduceIngr', 'ingr_id'=>$effect3['ingr'], 'quantity'=>$quantity);
//                        }
//                    if ($effect4)
//                        if (!$min || $effect4['effect']<$min)
//                        {
//                            $min = $effect4['effect'];
//                            $what = array('todo'=>'increaseAmount');
//                        }
//                    if (empty($what))
//                        throw new Exception ("Can't upgrade productivity...");
//                    if ($what['todo'] == 'reduceIngr')
//                        $this->ingredients[$what['ingr_id']]->base_quantity -= $what['quantity'];
//                    else
//                    {
//                        $this->base_amount++;
////                        echo '<pre>';
////                        var_dump($this->ingredients,'++++++++++++++++++', $base_product->i);
////                        die();
//                        foreach ($this->ingredients as $id=>$ing)
//                            $ing->base_quantity = $base_product->ingredients[$id]->base_quantity;
//                        //echo '</pre>';
//                    }
//                }
            } else
            {
               if ($this->base_amount > 1)
                    $this->base_amount = $this->base_amount - $this->base_level + $target_level;
               else
                    $this->base_amount = floor($this->base_amount + ($target_level - $this->base_level) * 0.34); 
               foreach ($this->ingredients as $id=>$ing)
               {
                   $this->ingredients[$id]->base_quantity = round($this->base_amount/($base_product->base_amount + ($target_level - $this->base_level)*0.1)*$base_product->ingredients[$id]->base_quantity);
               }
            }
        } elseif ($target_level < $base_product->base_level) {
            $amount_0 = $base_product->base_amount;
            if ($base_product->base_amount > 1)
            {
                $amount_0 = floor($base_product->base_amount/(1+$base_product->base_level/5));
                $this->base_amount = floor($target_level/$base_product->base_level*($base_product->base_amount - $amount_0)+$amount_0);
            }
            $ing_incr_coeff = $base_product->base_level / ($base_product->base_amount - $amount_0 + 1);
            if ($ing_incr_coeff < 1)
                $ing_incr_coeff = 1;
            foreach ($this->ingredients as $id=>$ing)
            {
                $ing_current_coeff = $ing_incr_coeff;
                //echo $this->ingredients[$id]->name.":".$ing_incr_coeff."|";
                if ($ing_current_coeff - 1  > $base_product->base_level/$base_product->ingredients[$id]->base_quantity)
                {
                    $ing_current_coeff = (($base_product->base_level + $base_product->ingredients[$id]->base_quantity) / $base_product->ingredients[$id]->base_quantity * 4 + $ing_incr_coeff)/5;
                }
                $this->ingredients[$id]->base_quantity = round(
                        $base_product->ingredients[$id]->base_quantity * 
                        (1 + ($ing_current_coeff-1) * ($base_product->base_level - $target_level) / $base_product->base_level));
            }
        }
            
    }
    
    public function tryToReduceIng(Model_Product $base_product, $quantity ,$num)
    {
        if (empty($this->ingredients))
            return false;
        $ings = array();
        foreach ($this->ingredients as $ingr)
        {
            $ings[] = $ingr;
        }
        if (!isset($ings[$num]))
            return false;
        $ing = $ings[$num];
        $old_profit = $this->getAddValue();
        $ing->base_quantity -= $quantity;
        $new_profit = $this->getAddValue();
        if ($ing->base_quantity/$base_product->ingredients[$ing->id]->base_quantity < 0.5)
        {
            $ing->base_quantity += $quantity;
            return false;
        }
        $ing->base_quantity += $quantity;
        return array('effect' => $new_profit/$old_profit, 'ingr'=>$ing->id);
    }
    
    public function tryToIncreaseAmount($base_product)
    {
        $old_profit = $this->getAddValue();
        $this->base_amount ++;
        $new_profit = $this->getAddValue();
        $this->base_amount --;
        return array ('effect' => $new_profit/$old_profit);
    }
    
    public function tryToIncreaseIng(Model_Product $base_product, $quantity ,$num)
    {
        if (empty($this->ingredients))
            return false;
        $ings = array();
        foreach ($this->ingredients as $ingr)
        {
            $ings[] = $ingr;
        }
        if (!isset($ings[$num]))
            return false;
        $ing = $ings[$num];
        $old_profit = $this->getAddValue();
        $ing->base_quantity += $quantity;
        $new_profit = $this->getAddValue();
        if ($ing->base_quantity/$base_product->ingredients[$ing->id]->base_quantity > 2)
        {
            $ing->base_quantity -= $quantity;
            return false;
        }
        $ing->base_quantity -= $quantity;
        return array('effect' => abs(($old_profit-$new_profit)/$base_product->getAddValue()), 'ingr'=>$ing->id);
    }
}

?>
