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
            && $this->registerhook('displayAdminProductsExtra')
            && $this->registerhook('displayProductTab');
    }

    public function hookDisplayAdminProductsExtra($params)
    {



        // return the html form
        // the submit button must have submitAddCustomField as name to work
        // the input text must have short_desc as name

        // instanciate the product class with the parameter get id_product
        // save the value of the form short_desc on product class
        // use the method save on product class to persist date in database



        $output = '';
        return $output;
    }

    public function hookDisplayProductTab($params)
    {

        // Here you have to return the value of short_desc with some html integration
        // instanciate the product class with the parameter get id_product
        // Get the product category default
        // instanciate the class Category with the field id_category_default from product class
        // use method getProducts from category class to get all the product from the category

        // return a html with the value with the 2 products you get

        return $output = '';


    }

}
