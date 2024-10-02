<?php
class AdminProductsController  extends AdminProductsControllerCore{
    public function postProcess()
    {
        if (Tools::isSubmit('submitAddCustomField')) {

            $idProduct = Tools::getValue('id_product');
            $shortDesc = Tools::getValue('short_desc');

            $result = $this->UpdateShortDesc($idProduct, $shortDesc); 

            if ($result) {
                $this->confirmations[] = 'Short description a été mis à jour.';
            } else {
                $this->confirmations[] = 'Il y a eu un problème!';
            }
        }

        parent::postProcess();
    }

    private function UpdateShortDesc($idProduct, $shortDesc)
    {
        return Db::getInstance()->update('product', array(
            'short_desc' => pSQL($shortDesc),
            'date_upd' => date('Y-m-d H:i:s')
        ), 'id_product = ' . (int)$idProduct);
    }
}
