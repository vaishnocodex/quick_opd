<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => env('L5_SWAGGER_API_TITLE', 'My API Documentation'),
                'description' => env('L5_SWAGGER_API_DESCRIPTION', 'API documentation for my Laravel application'),
                'version' => env('L5_SWAGGER_API_VERSION', '3.0.0'),
            ],

            'routes' => [
                /*
                 * Route for accessing API documentation interface
                 */
                'api' => 'api/documentation',

                /*
                 * Route for accessing parsed Swagger annotations
                 */
                'docs' => 'docs',

                /*
                 * Route for OAuth2 authentication callback
                 */
                'oauth2_callback' => 'api/oauth2-callback',

                /*
                 * Middleware allows preventing unexpected access to API documentation
                 */
                'middleware' => [
                    'api' => ['api'],
                    'asset' => [],
                    'docs' => ['api'],
                    'oauth2_callback' => ['api'],
                ],

                /*
                 * Route Group options
                 */
                'group_options' => [
                    'middleware' => ['api'],
                ],
            ],
            'paths' => [
                /*
                 * Edit to include full URL in UI for assets
                 */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', false),

                /*
                 * File name of the generated JSON documentation file
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * File name of the generated YAML documentation file
                 */
                'docs_yaml' => 'api-docs.yaml',

                /*
                 * Set this to `json` or `yaml` to determine which documentation file to use in UI
                 */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                /*
                 * Absolute paths to directory containing the swagger annotations
                 */ 
                'annotations' => [
                    base_path('routes/api.php'),
                    base_path('app/Http/Controllers/API'),
                    base_path('app/Models'),
                    base_path('app/Swagger/SwaggerConfig.php'), // Ensure this path is correct
                ],
            ],
        ],
    ],
    'defaults' => [
        'routes' => [
            /*
             * Route for accessing parsed Swagger annotations
             */
            'docs' => 'docs',

            /*
             * Route for OAuth2 authentication callback
             */
            'oauth2_callback' => 'api/oauth2-callback',

            /*
             * Middleware allows preventing unexpected access to API documentation
             */
            'middleware' => [
                'api' => ['api'],
                'asset' => [],
                'docs' => ['api'],
                'oauth2_callback' => ['api'],
            ],

            /*
             * Route Group options
             */
            'group_options' => [
                'middleware' => ['api'],
            ],
        ],

        'paths' => [
            /*
             * Absolute path to location where parsed annotations will be stored
             */
            'docs' => storage_path('api-docs'),
           
            /*
             * Absolute path to directory where to export views
             */
            'views' => base_path('resources/views/vendor/l5-swagger'),

            /*
             * Edit to set the API's base path
             */
            'base' => env('L5_SWAGGER_BASE_PATH', null),

            /*
             * Edit to set path where Swagger UI assets should be stored
             */
            'swagger_ui_assets_path' => env('L5_SWAGGER_UI_ASSETS_PATH', 'vendor/swagger-api/swagger-ui/dist/'),

            /*
             * Absolute path to directories that should be excluded from scanning
             */
            'excludes' => [
                base_path('storage'),
                base_path('vendor'),
            ],
        ],

        'scanOptions' => [
            /**
             * analyser: defaults to \OpenApi\StaticAnalyser .
             *
             * @see \OpenApi\scan
             */
            'analyser' => null,

            /**
             * analysis: defaults to a new \OpenApi\Analysis .
             *
             * @see \OpenApi\scan
             */
            'analysis' => null,

            /**
             * Custom query path processors classes.
             *
             * @link https://github.com/zircote/swagger-php/tree/master/Examples/processors/schema-query-parameter
             * @see \OpenApi\scan
             */
            'processors' => [
                // new \App\SwaggerProcessors\SchemaQueryParameter(),
            ],

            /**
             * pattern: string       $pattern File pattern(s) to scan (default: *.php) .
             *
             * @see \OpenApi\scan
             */
            'pattern' => '*.php',

            /*
             * Absolute path to directories that should be excluded from scanning
             */
            'exclude' => [
                base_path('storage'),
                base_path('vendor'),
            ],

            /*
             * Allows to generate specs either for OpenAPI 3.0.0 or OpenAPI 3.1.0.
             * By default the spec will be in version 3.0.0
             */
            'open_api_spec_version' => env('L5_SWAGGER_OPEN_API_SPEC_VERSION', \L5Swagger\Generator::OPEN_API_DEFAULT_SPEC_VERSION),
        ],

        /*
         * API security definitions. Will be generated into documentation file.
         */
        'securityDefinitions' => [
            'securitySchemes' => [ // Add this line
                'sanctum' => [
                    'type' => 'apiKey',
                    'description' => 'Enter your bearer token in the format (Bearer <token>)',
                    'name' => 'Authorization',
                    'in' => 'header',
                ],
            ], // Ensure the definitions are inside this array
        ],


        /*
         * Set this to `true` in development mode so that docs would be regenerated on each request
         * Set this to `false` to disable Swagger generation on production
         */
        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),

        /*
         * Set this to `true` to generate a copy of documentation in YAML format
         */
        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),

        /*
         * Edit to trust the proxy's IP address - needed for AWS Load Balancer
         */
        'proxy' => false,

        /*
         * Configs plugin allows fetching external configs instead of passing them to SwaggerUIBundle.
         * See more at: https://github.com/swagger-api/swagger-ui#configs-plugin
         */
        'additional_config_url' => null,

        /*
         * Apply a sort to the operation list of each API. It can be 'alpha' (sort by paths alphanumerically),
         * 'method' (sort by HTTP method).
         * Default is the order returned by the server unchanged.
         */
        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', 'alpha'),

        /*
         * Pass the validatorUrl parameter to SwaggerUi init on the JS side.
         * A null value here disables validation.
         */
        'validator_url' => null,

        /*
         * Swagger UI configuration parameters
         */
        'ui' => [
            'display' => [
                'dark_mode' => env('L5_SWAGGER_UI_DARK_MODE', false),
                'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),
                'filter' => env('L5_SWAGGER_UI_FILTERS', true),
            ],

            'authorization' => [
                'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),
                'oauth2' => [
                    'use_pkce_with_authorization_code_grant' => false,
                ],
            ],
        ],

        /*
         * Constants which can be used in annotations
         */
        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://localhost:8000/'),
        ],
    ],
];
