## Client Module Management

This application supports per-tenant module activation using:

- `nwidart/laravel-modules` for modular code.
- `gecche/laravel-multidomain` to load a dedicated `.env.<domain>` file per client.

### Domain Configuration

Register each tenant domain and its env suffix in `config/domain.php`:

```php
'domains' => [
    'client-a.test' => 'client-a.test',
    'client-b.test' => 'client-b.test',
],
```

With this in place, requests for `client-a.test` load `.env.client-a.test`.

### Controller & Routes

`App\Modules\Sixtyminutes\app\Http\Controllers\Admin\ClientModuleAdminController` exposes JSON endpoints (guarded by `auth` and `permission:super`):

- `GET /operate/client-modules` — shows the modules defined for every domain plus the runtime modules for the current request.
- `POST /operate/client-modules/{domain}/module` — set the module list for a domain. Accepts either `module` (string) or `modules` (array).
- `POST /operate/client-modules/current/module` — same as above but auto-detects the current domain.

### Using the Active Module at Runtime

`App\Providers\ClientModuleServiceProvider` runs on every request, reads the module list from the loaded `.env`, and makes it available via:

- `config('client-modules.active_module')`
- `config('client-modules.active_modules')`
- `app('client.active_module')`
- `app('client.active_modules')`
- Blade variables `$clientActiveModule` and `$clientActiveModules`

Module service providers can opt-in based on the current tenant using `App\Support\Modules\InteractsWithClientModules`. Example:

```php
public function boot(): void
{
    if (!$this->clientModuleIsActive($this->name)) {
        return;
    }

    // register routes, views, migrations...
}
```

The `Sixtyminutes` and `Stepfitness` providers already include this guard.

### Environment Variables

- `CLIENT_ACTIVE_MODULE`: comma-separated list of modules for the tenant (can be renamed via `CLIENT_MODULE_ENV_KEY`).
- `CLIENT_MODULE_SEPARATOR`: customize the delimiter (default `,`).
- `CLIENT_DEFAULT_MODULE` / `CLIENT_DEFAULT_MODULES`: fallback when the env value is missing.

Place these keys inside the relevant `.env.<domain>` file so each client loads only the modules you specify.


