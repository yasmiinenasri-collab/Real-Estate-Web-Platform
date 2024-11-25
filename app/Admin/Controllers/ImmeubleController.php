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
            $grid->column('picture')->image();
            $grid->column('rooms', __('Rooms'));
            $grid->column('toilets', __('Toilets'));
            $grid->column('air_conditioning', __('Air Conditioning'));
            $grid->column('heating', __('Heating'));
            $grid->column('ville', __('Ville'));
        
            // Ajouter les nouvelles colonnes
            $grid->column('transaction_type', __('Transaction Type'));
            $grid->column('status', __('Status'));
        
            $grid->column('created_at', __('Created at'));
            $grid->column('updated_at', __('Updated at'));
        
            // Ajouter un filtre par nom, type de transaction et ville
            $grid->filter(function ($filter) {
                $filter->like('name', __('Name')); // Filtre par nom
        
                // Filtre par type de transaction
                $filter->equal('transaction_type', __('Transaction Type'))->select([
                    'a_vendre' => 'À Vendre',
                    'a_louer' => 'À Louer',
                ]);
        
                // Filtre par ville
                $filter->equal('ville', __('Ville'))->select($this->getTunisianCities());
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
            $show->field('picture', __('Picture')); // Correction ici
            $show->field('rooms', __('Rooms'));
            $show->field('toilets', __('Toilets'));
            $show->field('air_conditioning', __('Air Conditioning'));
            $show->field('heating', __('Heating'));
        
            // Ajouter les nouveaux attributs
            $show->field('transaction_type', __('Transaction Type'));
            $show->field('status', __('Status'));
        
            // Commenter les champs created_at et updated_at si tu ne veux pas les afficher
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
    $form->image('picture', __('Picture'));
    $form->number('rooms', __('Rooms'));
    $form->number('toilets', __('Toilets'));
    $form->switch('heating', __('Heating'))->default(false);
    $form->switch('air_conditioning', __('Air Conditioning'))->default(false);
    $form->select('ville', __('Ville'))->options($this->getTunisianCities());
    
    // Rendre le type de transaction un radio button
    $form->radio('transaction_type', __('Transaction Type'))->options([
        'a_vendre' => 'À Vendre',
        'a_louer' => 'À Louer',
    ])->default('a_vendre');
    
    // Rendre le statut un radio button
    $form->radio('status', __('Status'))->options([
        'disponible' => 'Disponible',
        'vendu' => 'Vendu',
        'loué' => 'Loué',
    ])->default('disponible');

   
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
