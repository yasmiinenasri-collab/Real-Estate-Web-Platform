<?php

namespace App\Admin\Controllers;

use App\Models\Immeuble; // Importer le modèle Immeuble
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class ImmeubleController extends AdminController
{
    protected $title = 'Immeubles'; // Mettre à jour le titre

    protected function grid()
    {
        $grid = new Grid(new Immeuble());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('address', __('Address'));
        $grid->column('price', __('Price'));
        $grid->column('description', __('Description'));
        $grid->column('picture', __('Picture'));
        $grid->column('rooms', __('Rooms'));
        $grid->column('toilets', __('Toilets'));
        $grid->column('air_conditioning', __('Air Conditioning'));
        $grid->column('heating', __('Heating'));
        $grid->column('ville', __('Ville'));

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
   // Ajouter un filtre par nom seulement
   $grid->filter(function ($filter) {
    $filter->like('name', 'Name'); // Filtre par nom
});
        return $grid;
        
    }

    protected function detail($id)
    {
        $show = new Show(Immeuble::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('address', __('Address'));
        $show->field('price', __('Price'));
        $show->field('description', __('Description'));
        $show->field('picture', __('Picture'));
        $show->field('rooms', __('Rooms'));
        $show->field('toilets', __('Toilets'));
        $show->field('air_conditioning', __('Air Conditioning'));
        $show->field('heating', __('Heating'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Immeuble());
    
        $form->text('name', __('Name'));
        $form->textarea('address', __('Address'));
        $form->decimal('price', __('Price'));
        $form->textarea('description', __('Description'));
        $form->file('picture', __('Picture'));
        $form->number('rooms', __('Rooms'));
        $form->number('toilets', __('Toilets'));
        $form->switch('heating', __('Heating'))->default(false);
        $form->switch('air_conditioning', __('Air Conditioning'))->default(false);
        $form->select('ville', __('Ville'))->options($this->getTunisianCities());
    
        // Handle file upload during form saving
        $form->saving(function ($form) {
            if (request()->hasFile('picture')) {
                $path = request()->file('picture')->store('files', 'public');
                $form->model()->picture = $path;
            }
        });
    
        return $form;
    }
    
    protected function getTunisianCities()
{
    return [
        'Ariana' => 'Ariana',
        'Béja' => 'Béja',
        'Ben Arous' => 'Ben Arous',
        'Bizerte' => 'Bizerte',
        'El Kef' => 'El Kef',
        'Gabès' => 'Gabès',
        'Gafsa' => 'Gafsa',
        'Jendouba' => 'Jendouba',
        'Kairouan' => 'Kairouan',
        'Kasserine' => 'Kasserine',
        'Kébili' => 'Kébili',
        'Mahdia' => 'Mahdia',
        'Manouba' => 'Manouba',
        'Medenine' => 'Medenine',
        'Monastir' => 'Monastir',
        'Nabeul' => 'Nabeul',
        'Sfax' => 'Sfax',
        'Sidi Bouzid' => 'Sidi Bouzid',
        'Siliana' => 'Siliana',
        'Sousse' => 'Sousse',
        'Tataouine' => 'Tataouine',
        'Tozeur' => 'Tozeur',
        'Tunis' => 'Tunis',
        'Zaghouan' => 'Zaghouan'
    ];
}

}
