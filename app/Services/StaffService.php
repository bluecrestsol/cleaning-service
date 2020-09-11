<?php

namespace App\Services;
 
use App\Models\Admin;
use App\Models\AdminsLogin;
use Illuminate\Http\Request;
use App\Events\AdminActivity;
use App\Events\AdminLogin;
use Illuminate\Support\Arr;

/**
 * Business logic related to staff 
 */
class StaffService
{
    /**
     * @var Admin $model
     * @var AdminsLogin $countryService
     */
    protected $model, $adminsLogin;

    /**
     * Initialization
     *
     * @param Admin $model
     * @param AdminsLogin $adminsLogin
     */
    public function __construct(Admin $model, AdminsLogin $adminsLogin)
	{
        $this->model = $model;
        $this->adminsLogin = $adminsLogin;
    }

    /**
     * List of staff for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'admins.id',
            [
                'first_name',
                'last_name'
            ],
            'status',
            'roles.name'
        ];

        $searchable = [
            'first_name',
            'last_name',
            'status',
            'roles.name'
        ];

        $result = $this->model
            ->joinWithRoles()
            ->select(['admins.*', 'model_has_roles.role_id as role_id', 'roles.name as role_name'])
            ->ofDatatable($request, $searchable, $orderable);

        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];
        return $records;
    }

    /**
     * List of all staff
     *
     * @param array $filter
     * @return Collection<Admin>
     */
    public function getAll($filter)
    {
        return $this->model
            ->get();
    }

    /**
     * Get staff by ID
     *
     * @param int $id
     * @return Admin
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Get staff by email
     *
     * @param string $email
     * @return Admin
     */
    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Get staff by email
     *
     * @param int $id
     * @return Admin
     */
    public function getCurrent()
    {
        return auth('staff')->user();
    }

    /**
     * Logic for staff login
     *
     * @param array $credentials
     * @return bool
     */
    public function login($credentials)
    {
        $remember = Arr::pull($credentials, 'remember', 0);
        $admin = $this->getByEmail($credentials['email']);

        $success = true;
        if(auth('staff')->attempt($credentials, $remember)) {
            session([
                'first_name' => $admin->first_name,
                'last_name' => $admin->last_name,
                'locale' => 'en'
            ]);
            // events
            event(new AdminLogin(
                $admin,
                $this->adminsLogin::STATUS['SUCCESS']
            ));
            event(new AdminActivity($admin));
        } else {
            if (isset($admin)) {
                event(new AdminLogin(
                    $admin,
                    $this->adminsLogin::STATUS['UNSUCCESSFUL']
                ));
            }
            $success = false;
        }
        return $success;
    }

    /**
     * Logic for staff logout
     *
     * @return void
     */
    public function logout() {
        event(new AdminActivity(app('shared')->get('admin')));
        auth('staff')->logout();
        session()->forget(['first_name', 'last_name']);
    }

    /**
     * Create a staff
     *
     * @param array $data
     * @return Admin
     */
    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);
        $role = isset($data['role']) ? $data['role'] : null;
        unset($data['role']);
        $admin = $this->model->create($data);
        if (!empty($role)) {
            $admin->assignRole($role);
        }
        return $admin;
    }

    /**
     * Update staff by ID
     *
     * @param int $id
     * @param array $data
     * @return Admin
     */
    public function update($id, $data)
    {
        if (!empty($data['password'])) $data['password'] = bcrypt($data['password']);
        else unset($data['password']);
        $role = isset($data['role']) ? $data['role'] : null;
        unset($data['role']);
        $admin = $this->getById($id);
        $admin->update($data);
        if (!empty($role)) {
            $admin->syncRoles([$role]);
        }
        return $admin;
    }

    /**
     * Update last activity of staff
     *
     * @param Admin $admin
     * @return void
     */
    public function updateLastActivity($admin)
    {
        $ip = request()->getClientIp();
        $admin->last_active_at = now();
        $admin->last_active_ip = $ip;
        $admin->last_active_geo = geoip($ip)->iso_code;
        $admin->save();
    }

    /**
     * Update staff by email
     *
     * @param string $email
     * @param array $data
     * @return void
     */
    public function updateByEmail($email, $data)
    {
        $admin = $this->getByEmail($email);
        $admin->update($data);
    }

    /**
     * Delete staff by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Record staff login by id
     *
     * @param int $id
     * @param array $data
     * @return Admin
     */
    public function recordLoginById($id, $data)
    {
        $data['user_id'] = $id;
        return $this->adminsLogin->create($data);
    }
}