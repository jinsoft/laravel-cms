<?php
/**
 * Created by PhpStorm.
 * User: xiaojin
 * Email: job@ainiok.com
 * Date: 2018/9/12 23:48
 */

namespace App\Repository;

class Category
{
    public function getAllCategory()
    {
        return (new \App\Model\Category())->newQuery()
            ->orderBy('sort', 'asc')
            ->orderBy('name', 'asc')
            ->get()->toArray();
    }
}