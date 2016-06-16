<?php
class Model_Product extends Model_Abstract{
    
    public $id;
    public $name;
    public $minutes;
    public $cost_all;
    public $price_one;
    public $base_amount;
    public $building_id;
    public $ingredients;
    protected $_tablename = 'mi_products';
 
    public function __construct($product_id) {
        $this->getFromDB($product_id);
    }
    
    public function fillIngredients()
    {
        $ingredients_data = $this->_db()->select('select ingredient_id, base_quantity from mi_prod_content where prod_id=?d', $this->id);
        foreach ($ingredients_id as $ing)
        {
            $this->ingredients[$ing['ingredient_id']] = new Model_Ingredient($ing_id);
            $this->ingredients[$ing['ingredient_id']]->base_quantity = $ing['base_quantity'];
            $this->ingredients[$ing['ingredient_id']]->fillIngredients();
        }
    }
}

?>
