<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $group = array(
        // Staff
        array(
            'service' => [
                'class' => 'App\Services\StaffService',
                'dependencies' => [
                    'App\Models\Admin',
                    'App\Models\AdminsLogin',
                ]
            ],
        ),
        // Roles
        array(
            'service' => [
                'class' => 'App\Services\RoleService',
                'dependencies' => [
                    'App\Models\Role',
                    'App\Models\Permission'
                ]
            ],
        ),
        // States
        array(
            'service' => [
                'class' => 'App\Services\StateService',
                'dependencies' => [
                    'App\Models\State'
                ]
            ],
        ),
        // Cities
        array(
            'service' => [
                'class' => 'App\Services\CityService',
                'dependencies' => [
                    'App\Models\City'
                ]
            ],
        ),
        // Districts
        array(
            'service' => [
                'class' => 'App\Services\DistrictService',
                'dependencies' => [
                    'App\Models\District'
                ]
            ]
        ),
        // Languages
        array(
            'service' => [
                'class' => 'App\Services\LanguageService',
                'dependencies' => [
                    'App\Models\Language'
                ]
            ],
        ),
        // Currencies
        array(
            'service' => [
                'class' => 'App\Services\CurrencyService',
                'dependencies' => [
                    'App\Models\Currency'
                ]
            ],
        ),
        // Countries
        array(
            'service' => [
                'class' => 'App\Services\CountryService',
                'dependencies' => [
                    'App\Models\Country'
                ]
            ]
        ),
        // Customer
        array(
            'service' => [
                'class' => 'App\Services\CustomerService',
                'dependencies' => [
                    'App\Models\Customer',
                    'App\Services\CountryService',
                ]
            ],
        ),
        // Companies
        array(
            'service' => [
                'class' => 'App\Services\CompanyService',
                'dependencies' => [
                    'App\Models\Company'
                ]
            ],

        ),
        // Places
        array(
            'service' => [
                'class' => 'App\Services\PlaceService',
                'dependencies' => [
                    'App\Models\Place',
                    'App\Services\CountryService',
                ]
            ]
        ),
        // Place Categories
        array(
            'service' => [
                'class' => 'App\Services\PlacesCategoryService',
                'dependencies' => [
                    'App\Models\PlacesCategory'
                ]
            ]
        ),
        // Crew members
        array(
            'service' => [
                'class' => 'App\Services\CrewMemberService',
                'dependencies' => [
                    'App\Models\CrewMember',
                    'App\Services\CountryService'
                ]
            ]
        ),
        // Services
        array(
            'service' => [
                'class' => 'App\Services\ServiceService',
                'dependencies' => [
                    'App\Models\Service'
                ]
            ]
        ),
        // Bookings
        array(
            'service' => [
                'class' => 'App\Services\BookingService',
                'dependencies' => [
                    'App\Models\Booking',
                    'App\Services\ServiceService'
                ]
            ]
        ),
        // Appointments
        array(
            'service' => [
                'class' => 'App\Services\AppointmentService',
                'dependencies' => [
                    'App\Models\Appointment',
                    'App\Services\CountryService',
                    'App\Services\PlaceService'
                ]
            ]
        ),
        // Country Languages
        array(
            'service' => [
                'class' => 'App\Services\CountryLanguageService',
                'dependencies' => [
                    'App\Models\Country',
                    'App\Models\Language'
                ]
            ]
        ),
        // Country Currencies
        array(
            'service' => [
                'class' => 'App\Services\CountryCurrencyService',
                'dependencies' => [
                    'App\Models\Country',
                    'App\Models\Currency'
                ]
            ]
        ),
        // Company Countries
        array(
            'service' => [
                'class' => 'App\Services\CompanyCountryService',
                'dependencies' => [
                    'App\Models\Company',
                    'App\Models\Country'
                ]
            ],
        ),
        // Faqs
        array(
            'service' => [
                'class' => 'App\Services\FaqService',
                'dependencies' => [
                    'App\Models\FaqQuestion'
                ]
            ],
        ),
        // Faq Categories
        array(
            'service' => [
                'class' => 'App\Services\FaqCategoryService',
                'dependencies' => [
                    'App\Models\FaqCategory'
                ]
            ],
        ),
        // Contracts
        array(
            'service' => [
                'class' => 'App\Services\ContractService',
                'dependencies' => [
                    'App\Models\Contract',
                    'App\Services\CountryService'
                ]
            ],
        ),
        // Agents
        array(
            'service' => [
                'class' => 'App\Services\AgentService',
                'dependencies' => [
                    'App\Models\Agent',
                    'App\Services\CountryService'
                ]
            ]
        ),
        // Pre
        array(
            'service' => [
                'class' => 'App\Services\PreService',
                'dependencies' => [
                    'App\Services\StaffService',
                    'App\Services\CompanyCountryService'
                ]
            ],
        ),
    );
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {   
        // singleton
        $this->app->singleton('shared', function() {
            return new \App\Services\SharingService();
        });
        // bind
        foreach ($this->group as $key => $item) {
            $this->app->bind($item['service']['class'], function ($app) use ($item) {
                return $this->attachDependency($app, $item['service']);
            });
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function attachDependency($app, $item)
    {
        $dependencies = [];
        foreach ($item['dependencies'] as $dependency) {
            $dependencies[] = $app->make($dependency);
        }
        return new $item['class'](...$dependencies);
    }
}
