<?php namespace Uemura\Crm;

use System\Classes\PluginBase;
use Backend;
/**
 * sitepoint_demo Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Project management',
            'description' => 'Manage your suppliers and operations.',
            'author'      => 'UEMURA Younes',
            'icon'        => 'icon-leaf'
        ];
    }
    
    public function registerPermissions()
    {
        return [
            'uemura.Crm.manage_suppliers' => [
                'label' => 'Manage Suppliers',
                'tab' => 'Crm'
            ],
            'uemura.Crm.manage_operations' => [
                'label' => 'Manage Operations',
                'tab' => 'Crm'
            ],
            'uemura.Crm.manage_agentupdates' => [
                'label' => 'Manage Agent Updates',
                'tab' => 'Crm'
            ]
        ];
    }

    public function boot()
    {
        \Backend\Models\User::extend(function($model){
            $model->belongsTo['supplier'] = ['Uemura\Crm\Models\Supplier'];
        });

        \Backend\Controllers\Users::extendListColumns(function ($list) {
            $list->addColumns([
                'supplier' => [
                    'label' => 'Supplier',
                    'relation' => 'supplier',
                    'select' => 'name'
                ]
            ]);
        });
    }
public function registerNavigation()
    {
  
        return [
            'crm' => [
                'label'       => 'Crm',
                'url'         => Backend::url('uemura/crm/operations'),
                'icon'        => 'icon-copy',
                'permissions' => ['crm.*'],
                'order'       => 200,

                'sideMenu' => [
                    'supplier' => [
                        'label'       => 'Supplier',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('uemura/crm/operations'),
                        'permissions' => ['crm.*']
                    ],
                    'agent' => [
                        'label'       => 'Agent',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('uemura/crm/agentupdates'),
                        'permissions' => ['crm.*']
                    ]
                ]
            ]
        ];
    
 
    }
	
	public function registerFormWidgets()
    {
        return [
            'Uemura\Crm\FormWidgets\Actorbox' => [
                'label' => 'Actorbox field',
                'code'  => 'actorbox'
            ]    
        ];
    }
}
