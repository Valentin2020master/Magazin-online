<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product;

class ProductController extends AppController {

    public function viewAction(){
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);
        if (!$product){
            throw new \Exception('Pagina lipseste', 404);
        }
        // farmaturi
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

        //Marfuri de legatura
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$product->id]);
        $this->set(compact('product', 'related'));

        //inregistrarea in coki al produselor
        $p_model = new Product();
        $p_model->setRecentlyViewed($product->id);

        //Produsele vizualizate
        $r_viewed = $p_model->getRecentlyViewed();
        $recentlyViewed = null;
        if($r_viewed){
            $recentlyViewed = \R::find('product', 'id IN (' . \R::genSlots($r_viewed) . ') LIMIT 3', $r_viewed);

        }


        // galeria
        $gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);

        //tipurile de modificari
        $mods = \R::findAll('modification', 'product_id = ?', [$product->id]);




        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product', 'related', 'gallery', 'recentlyViewed', 'breadcrumbs', 'mods'));
    }

}