# Core Concepts

## Overview

PageStudio Framework is built around several core concepts that shape its architecture and functionality. Understanding these concepts is crucial for effectively using the framework.

## Key Concepts

### 1. Multi-Tenant Architecture

The framework's multi-tenant architecture allows multiple applications to coexist within a single codebase. This is achieved through:

- **Child Applications**: Independent applications that share the framework's core
- **Front Controllers**: Entry points for each application
- **Shared Resources**: Common components and services accessible to all applications

### 2. The Kernel

The kernel is the core of the framework, responsible for:

- Bootstrapping the application
- Managing environment configurations
- Handling routing between applications
- Providing shared services

For more details, see [The Kernel](../the-kernel.md).

### 3. Application Structure

Each application in the framework follows a structured organization:

```
my-project/
├── public/
│   └── index.php         # Main front controller
├── apps/
│   ├── app1/
│   │   └── index.php     # Child front controller
│   └── app2/
│       └── index.php     # Child front controller
└── vendor/
    └── pagestudio/
        └── framework/    # PageStudio Framework
```

### 4. Routing System

The routing system provides:

- Central request handling
- Route delegation to child applications
- Middleware support
- Flexible URL patterns

### 5. Database Abstraction

The database layer features:

- Adapter pattern for different database types
- Query building
- Connection management
- Transaction support

## Best Practices

1. **Application Independence**
   - Keep child applications as independent as possible
   - Share only necessary resources
   - Use clear boundaries between applications

2. **Resource Management**
   - Use dependency injection
   - Share common services through the kernel
   - Maintain clear configuration separation

3. **Security**
   - Implement proper access controls
   - Use environment-specific configurations
   - Follow secure coding practices

## Further Reading

- [Application Structure](application-structure.md)
- [Database Layer](database.md)
- [Configuration](configuration.md)
