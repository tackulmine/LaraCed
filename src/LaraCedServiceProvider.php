<?php

namespace LaraCed;

use Illuminate\Support\ServiceProvider;

class LaraCedServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Blueprint::macro('ced', function() {
            $this->unsignedInteger('created_by')->nullable()->index();
            $this->unsignedInteger('updated_by')->nullable()->index();
            $this->unsignedInteger('deleted_by')->nullable()->index();
        });

        Blueprint::macro('creator', function($name) {
            if (!isset($name) or empty($name)) 
                $name = 'created_by';
            $this->unsignedInteger($name)->nullable()->index();
        });
        Blueprint::macro('editor', function($name) {
            if (!isset($name) or empty($name)) 
                $name = 'updated_by';
            $this->unsignedInteger($name)->nullable()->index();
        });
        Blueprint::macro('destroyer', function($name) {
            if (!isset($name) or empty($name)) 
                $name = 'deleted_by';
            $this->unsignedInteger($name)->nullable()->index();
        });

        Blueprint::macro('dropCed', function() {
            $this->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });
    }
}