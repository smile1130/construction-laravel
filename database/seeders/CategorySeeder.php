<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mateb = new Category();
        $mateb->name = 'Materiais Basicos';
        $mateb->save();

        $blti = new Category();
        $blti->parent_id = $mateb->id;
        $blti->name = 'Blocos & Tijolos';
        $blti->save();

        $blococ = new Category();
        $blococ->parent_id = $blti->id;
        $blococ->name = 'Bloco Ceramico';
        $blococ->save();

        $blococ_1 = new Category();
        $blococ_1->parent_id = $blococ->id;
        $blococ_1->name = 'Bloco 14*30';
        $blococ_1->measurement = 'un';
        $blococ_1->save();

        $acos = new Category();
        $acos->parent_id = $mateb->id;
        $acos->name = 'Acos';
        $acos->save();

        $verga = new Category();
        $verga->parent_id = $acos->id;
        $verga->name = 'Vergalhao';
        $verga->save();

        $verga_1 = new Category();
        $verga_1->parent_id = $verga->id;
        $verga_1->name = "CA50 06,30 MM RETO 12,0";
        $verga_1->measurement = "pc";
        $verga_1->save();

        $verga_2 = new Category();
        $verga_2->parent_id = $verga->id;
        $verga_2->name = "CA50 08,30 MM RETO 12,0";
        $verga_2->measurement = "pc";
        $verga_2->save();

        $verga_3 = new Category();
        $verga_3->parent_id = $verga->id;
        $verga_3->name = "CA50 10,30 MM RETO 12,0";
        $verga_3->measurement = "pc";
        $verga_3->save();

        $verga_4 = new Category();
        $verga_4->parent_id = $verga->id;
        $verga_4->name = "CA50 12,30 MM RETO 12,0";
        $verga_4->measurement = "pc";
        $verga_4->save();

        $verga_5 = new Category();
        $verga_5->parent_id = $verga->id;
        $verga_5->name = "CA50 16,30 MM RETO 12,0";
        $verga_5->measurement = "pc";
        $verga_5->save();

        $verga_6 = new Category();
        $verga_6->parent_id = $verga->id;
        $verga_6->name = "CA60 05,30 NERV RETO 12,0";
        $verga_6->measurement = "pc";
        $verga_6->save();

        $arames = new Category();
        $arames->parent_id = $acos->id;
        $arames->name = 'Arames';
        $arames->save();

        $arames_1 = new Category();
        $arames_1->parent_id = $arames->id;
        $arames_1->name = 'ARAME 12';
        $arames_1->measurement = 'kg';
        $arames_1->save();

        $arames_2 = new Category();
        $arames_2->parent_id = $arames->id;
        $arames_2->name = 'ARAME 18';
        $arames_2->measurement = 'kg';
        $arames_2->save();

        $ciment = new Category();
        $ciment->parent_id = $mateb->id;
        $ciment->name = 'Cimentos, Areias e pedras';
        $ciment->save();

        $cimento = new Category();
        $cimento->parent_id = $ciment->id;
        $cimento->name = 'Cimentos';
        $cimento->save();
        
        $cimento_1 = new Category();
        $cimento_1->parent_id = $cimento->id;
        $cimento_1->name = 'Cimento Kaue';
        $cimento_1->measurement = "sc";
        $cimento_1->save();

        $cal = new Category();
        $cal->parent_id = $ciment->id;
        $cal->name = 'Cal';
        $cal->save();

        $cal_1 = new Category();
        $cal_1->parent_id = $cal->id;
        $cal_1->name = 'Cal Hidratado';
        $cal_1->measurement = 'sc';
        $cal_1->save();

        $areia = new Category();
        $areia->parent_id = $ciment->id;
        $areia->name = 'Areia';
        $areia->save();

        $areia_1 = new Category();
        $areia_1->parent_id = $areia->id;
        $areia_1->name = 'Areia Fina';
        $areia_1->measurement = 'm3';
        $areia_1->save();

        $concre = new Category();
        $concre->parent_id = $ciment->id;
        $concre->name = 'Concreto';
        $concre->save();

        $concre_1 = new Category();
        $concre_1->parent_id = $concre->id;
        $concre_1->name = 'FCK25';
        $concre_1->measurement = 'm3';
        $concre_1->save();
    }
}