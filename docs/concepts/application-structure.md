# Application Structure

## Overview

PageStudio Framework uses a structured approach to organizing multiple applications within a single codebase. This document outlines the recommended application structure and explains the purpose of each component.

## Directory Structure

```
my-project/
├── public/                    # Public directory
│   ├── index.php             # Main front controller
│   ├── .htaccess             # Apache configuration
│   └── assets/               # Public assets
├── apps/                     # Child applications
│   ├── app1/
│   │   ├── config/          # App-specific configuration
│   │   ├── src/             # Application source code
│   │   ├── templates/       # View templates
│   │   └── index.php        # Child front controller
│   └── app2/
│       ├── config/
│       ├── src/
│       ├── templates/
│       └── index.php
├── config/                   # Shared configuration
│   ├── app.php              # Main app configuration
│   └── database.php         # Database configuration
├── src/                     # Shared source code
│   └── Common/              # Shared components
├── vendor/                  # Composer dependencies
├── .env                     # Environment variables
└── composer.json           # Composer configuration

```

## Component Details

### 1. Public Directory

The `public` directory contains publicly accessible files:

- `index.php`: Main front controller
- Static assets (CSS, JavaScript, images)
- Web server configuration files

### 2. Child Applications

Each child application in the `apps` directory is a self-contained unit with:

- Independent configuration
- Dedicated source code
- Separate templates
- Own front controller

### 3. Shared Resources

Common components shared across applications:

- Configuration files
- Shared libraries
- Common services
- Utility functions

### 4. Configuration

Configuration follows a hierarchical structure:

1. Environment variables (`.env`)
2. Global configuration (`config/`)
3. Application-specific configuration (`apps/*/config/`)

## Best Practices

### 1. Application Independence

- Keep child applications as independent as possible
- Share only necessary resources
- Use clear boundaries between applications

### 2. Configuration Management

- Use environment variables for sensitive data
- Keep configuration hierarchical
- Override global config at application level

### 3. Resource Organization

- Group related files together
- Use consistent naming conventions
- Maintain clear separation of concerns

### 4. Security Considerations

- Keep sensitive files outside public directory
- Use proper file permissions
- Implement access controls

## Implementation Example

### Main Front Controller

```php
// public/index.php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ps\Framework\Boot\Kernel;

$kernel = Kernel::bootstrap();
$kernel->run();
```

### Child Front Controller

```php
// apps/app1/index.php
<?php

use Ps\Framework\Boot\Kernel;

$kernel = Kernel::bootstrap();

// Define application-specific routes
$kernel->map('/app1', function() {
    // Application logic
});

$kernel->run();
```

### Configuration File

```php
// config/app.php
return [
    'name' => 'My Multi-Tenant Application',
    'debug' => env('APP_DEBUG', false),
    'apps' => [
        'app1' => [
            'path' => __DIR__ . '/../apps/app1',
            'namespace' => 'App1'
        ],
        'app2' => [
            'path' => __DIR__ . '/../apps/app2',
            'namespace' => 'App2'
        ]
    ]
];
```

## Additional Considerations

1. **Version Control**
   - Use `.gitignore` for sensitive files
   - Document dependencies
   - Maintain change history

2. **Development Workflow**
   - Set up development environments
   - Use consistent coding standards
   - Implement testing structure

3. **Deployment**
   - Configure web server properly
   - Set up deployment scripts
   - Manage environment variables
