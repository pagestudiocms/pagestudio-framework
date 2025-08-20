# PageStudio Framework

A modern PHP framework designed for managing multi-tenant applications and facilitating application transitions.

## Overview

PageStudio Framework is a specialized PHP framework that enables concurrent development and management of multiple applications within a single repository. It provides an elegant solution for scenarios where applications are too complex to be mere modules but too interconnected to be completely separate.

## Key Features

- **Multi-Tenant Architecture**: Manage multiple applications within a single codebase
- **Flexible Routing**: Central routing system to handle requests across multiple applications
- **Modern PHP Support**: Compatible with PHP 7.2+ and PHP 8.0
- **Framework Integration**: Built-in support for CodeIgniter 4 and Symfony components
- **Robust Database Layer**: Advanced database abstraction with adapter/driver pattern
- **Clean Architecture**: Kernel-based design inspired by modern PHP practices

## When to Use PageStudio Framework

This framework is ideal when you need to:

- Manage multiple interconnected applications that share common resources
- Migrate applications between frameworks (e.g., CodeIgniter v3 to v4)
- Build multi-tenant applications with shared infrastructure
- Maintain separate applications that are too interrelated to be completely isolated

## Quick Start

### Installation

```bash
composer require pagestudio/framework
```

### Basic Setup

1. Set up your main front controller
2. Configure your child applications
3. Define your routing structure

For detailed setup instructions, see our [Getting Started Guide](docs/getting-started.md).

## Documentation

- [Concepts](docs/concepts/README.md)
- [The Kernel](docs/the-kernel.md)
- [Application Structure](docs/concepts/application-structure.md)
- [Database Layer](docs/concepts/database.md)
- [Configuration](docs/concepts/configuration.md)

## Requirements

- PHP 7.2 or higher
- Composer
- PDO PHP Extension (for database functionality)

## License

Licensed under the MIT License. See [LICENSE](LICENSE) for details.

Copyright (c) 2024 CosmoInteractive, LLC

## Acknowledgements

This framework builds upon the excellent work of:
- [CodeIgniter](http://codeigniter.com)
- [Symfony](https://symfony.com)
- [Bramus Router](https://github.com/bramus/router)