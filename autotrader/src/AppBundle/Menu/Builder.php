<?php

namespace AppBundle\Menu;

use Knp\Menu\MenuFactory;

class Builder{
    
    public function mainMenu(MenuFactory $factory, array $options){
        $menu = $factory->createItem('root');
        $menu->addChild('Home', ['route' => 'homepage'] );
        $menu->addChild('Offer', ['route' => 'offer']);
        $menu->addChild('Manage car', ['route' => 'car_index']);
        $menu->setChildrenAttribute('class', 'nav navbar');
        return $menu;
    }
}