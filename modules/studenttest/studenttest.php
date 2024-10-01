<?php


class StudentTest extends Module
{

    public function __construct()
    {
        $this->name = 'studenttest';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Nhust';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Module Student');
        $this->description = $this->l('Displays something in product page.');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6.99.99');
    }


    public function install()
    {
        return
            parent::install() && $this->registerHook('displayHeader')
            && $this->registerHook('displayAdminProductsExtra')
            && $this->registerHook('displayProductTab');
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        (int)$idProduct = Tools::getValue('id_product');
        $token = Tools::getValue('token');

        $shortDesc = $this->getValueOfShortDesc($idProduct);

        $html = '    
            <form action="" method="post">
                <input type="hidden" name="id_product" value="' . $idProduct . '" />
                <input type="hidden" name="token" value="' . $token . '" />
                <input type="hidden" name="submitAddCustomField" value="1" />
                <label for="short_desc">Short description</label>
                <textarea name="short_desc" id="short_desc">' . htmlspecialchars($shortDesc) . '</textarea>
                <button type="submit" name="submitAddCustomField">' . 'Envoyer' . '</button>
            </form>';
        return $html;
    }

    public function hookDisplayProductTab($params)
    {
        (int)$product = new Product($params['product']->id);

        $shortDesc = $product->short_desc;

        Tools::displayError('Valeur de $short_desc: ', $shortDesc);

        $html = '<div class="short_desc">
                <h3>Description courte</h3>'
                . $shortDesc . 
                '</div>';
        return $html;
    }

    private function getValueOfShortDesc($idProduct)
    {
        return Db::getInstance()->getValue('SELECT short_desc FROM ' . _DB_PREFIX_ . 'product WHERE id_product = ' . $idProduct);
    }

}
