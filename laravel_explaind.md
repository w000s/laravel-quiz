Idee: Maak hier een quiz van vragen enigszins bij elkaar gecategoriseerd, vragen bij elkaar en commands bij elkaar. vervolgens meerdere levels maken 1ste level is meer basic shit, vervolgens meer in depth

Vraagstelling: definition, commando's, in depth explanation and opsommingen, en file locations

Not signed in users kunnen oneindig random vragen krijgen, ingelogde users hebben categories + leaderbord

FIRST STEPS

The entry point for all requests to a laravel application is the public/index.php file.

All requests are directed to this file by your web server (apache/nginx)

Index.php loads the composer generated autoloader definition, and then retrieves an instance of the laravel application from bootstrap/app.php.

The first action taken by laravel itself is to create an instance of the application / service container.

HTTP / CONSOLE KERNELS

Next, the incoming request is sent to either the http kernel or the console kernel, depending on the type of request that is entering the application. The http kernel is located in app\HTTP\Kernel.php.

The http kernel extend the Illuminate\Foundation\Http\Kernel class, which defines an array of bootstrappers that will be run before the request is executed. These bootstrappers configure error handling, logging etc. The http kernel also defines a list of HTTP middleware that all requests must pass before being handled by the applications. These middleware handle reading and writing the HTTP session, determining if the application is in maintenance mode, verifying the csrf token etc.

The method signature for the HTTP kernel's handle method is quite simple. It receives a Request and returns a Response.

SERVICE PROVIDERS

One of the most important kernal bootstrapping actions is loading the service providers for your application.

Service providers are responsible for bootstrapping all of the framework's various components, such as Database, queue, validation, and routing components. All of the service providers for the application are configured in the config/app.php configuration file's providers array.

Laravel will iterate through this list of providers and instantiate each of them. After instantiating the providers, the register method will be called on all of the providers. Then, once all of the providers have been registered, the boot method will be called on each provider. This is so service providers may depend on every container binding being registered and available by the time their boot method is executed.

Essentially every major feature offered by Laravel is bootstrapped and configured by a service provider. Since they bootstrap and configure so many features offered by the framework, service providers are the most important aspect of the entire Laravel bootstrap process.

ROUTING

One of the most important service providers in your application is the App\Providers\RouteServiceProvider. This service provider loads the route files contained within your application's routes directory.

Once the application has been bootstrapped and all service providers have been registered, the Request will be handed off to the router for dispatching. The router will dispatch the request to a route or controller, as well as run any route specific middleware.

Middleware provide a convenient mechanism for filtering or examining HTTP requests entering your application. For example, Laravel includes a middleware that verifies if the user of your app is authenticated. If the user is not authenticated, the middleware will redirect the user to the login screen. However, if the user is authenticated, the middleware will allow the request to proceed further into the application. Some middleware are assigned to all routes within the application, like those defined in the $middleware property of your HTTP kernel, while some are only assigned to specific routes or route groups.

If the requests passes through all of the matched route's assigned middleware, the route or controller method will be executed and the response returned by the route or controller method will be send back through the route's chain of middleware.

FINISHING UP

Once the route or controller method returns a response, the response will travel back outward through the route's middleware, giving the application a chance to modify or examine the outgoing response.

Finally, once the response travels back through the middleware, the HTTP Kernel's handle method returns the response object and the index.php file calls the send method on the returned response.

![Picture](../Pictures/Screenshots/Screenshot%20from%202023-02-07%2014-34-47.png)

The send method sends the response ontent to the user's web browser.

FOCUS ON SERVICE PROVIDERS

Service providers are truly the key to bootstrapping a Laravel application. The application instance is created, the service providers are registered, and the request is handled to the bootstrapped application. The Application's default service providers are stored in the app/Providers directory.

The AppServiceProvider is a great place to add your application's own bootstrapping and service container bindings. For large Applications, you may wish to create several service providers.

There are two types to create models in your database, Eloquent orm and query builder.
