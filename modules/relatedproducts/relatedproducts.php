<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class RelatedProducts extends Module
{
    public function __construct()
    {
        $this->name = 'relatedproducts';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Havet';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Related Products');
        $this->description = $this->l('Displays related products on product page');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayFooterProduct');
    }

    public function hookDisplayFooterProduct($params)
    {
        $product = $params['product'];
        $idProduct = $product->id;
        $idCategory = $product->id_category_default;

        $relatedProducts = $this->getRelatedProducts($idCategory, $idProduct);
        $this->context->controller->addCSS($this->_path . 'css/relatedproducts.css', 'all');


        $this->context->smarty->assign([
            'related_products' => $relatedProducts,
        ]);

        return $this->display(__FILE__, 'related_products.tpl');
    }

    private function getRelatedProducts($idCategory, $idProduct)
    {
        $query = 'SELECT p.id_product, pl.name, p.price
        FROM '._DB_PREFIX_.'product p
        INNER JOIN '._DB_PREFIX_.'product_lang pl ON p.id_product = pl.id_product
        WHERE p.id_category_default = '.(int)$idCategory.'
        AND p.id_product != '.(int)$idProduct.'
        ORDER BY RAND()
        LIMIT 2';

        // Exécuter la requête et récupérer les résultats
        return Db::getInstance()->executeS($query);
    }


}