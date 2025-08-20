# Database Layer

## Overview

PageStudio Framework provides a robust database abstraction layer that facilitates database operations across different database management systems while maintaining consistency and security.

## Architecture

The database layer is built on three main concepts:

### 1. Adapters

Adapters serve as bridges between your application and different database systems. They provide a consistent interface while handling system-specific operations.

```php
namespace Ps\Framework\Database\Adapter;

interface AdapterInterface 
{
    public function connect();
    public function query($sql, $bind = []);
    public function getDriver();
    public function getPlatform();
}
```

### 2. Drivers

Drivers handle the actual communication with specific database systems. They implement:

- Connection management
- Query execution
- Result handling
- Transaction support

### 3. Results

The Result interface provides a consistent way to handle query results:

- Iteration over result sets
- Row counting
- Field information
- Generated values (e.g., auto-increment IDs)

## Usage Examples

### Basic Connection

```php
use Ps\Framework\Database\Adapter\Pdo\MysqlDriver;

$config = [
    'host' => 'localhost',
    'dbname' => 'mydb',
    'user' => 'user',
    'password' => 'password'
];

$driver = new MysqlDriver($config);
$connection = $driver->connect();
```

### Query Execution

```php
// Using prepared statements
$statement = $connection->prepare('SELECT * FROM users WHERE id = ?');
$result = $statement->execute([1]);

// Iterating results
foreach ($result as $row) {
    // Process row data
}
```

## Best Practices

1. **Always Use Prepared Statements**
   - Prevents SQL injection
   - Improves query performance
   - Handles data type conversion

2. **Connection Management**
   - Use connection pooling for better performance
   - Close connections when not needed
   - Monitor connection status

3. **Error Handling**
   - Implement proper exception handling
   - Log database errors
   - Provide meaningful error messages

4. **Transaction Management**
   - Use transactions for data integrity
   - Handle transaction failures gracefully
   - Avoid long-running transactions

## Advanced Features

### 1. Query Building

```php
$query = $connection->createQueryBuilder()
    ->select('u.*')
    ->from('users', 'u')
    ->where('u.status = ?')
    ->setParameter(0, 'active');
```

### 2. Result Set Management

```php
// Buffered results
$result->buffer();

// Field information
$fieldCount = $result->getFieldCount();

// Affected rows
$affected = $result->getAffectedRows();
```

### 3. Transaction Support

```php
try {
    $connection->beginTransaction();
    // ... perform operations
    $connection->commit();
} catch (Exception $e) {
    $connection->rollback();
    throw $e;
}
```

## Configuration

Example configuration in your application:

```php
return [
    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'myapp',
        'username' => 'user',
        'password' => 'password',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ]
];
```
