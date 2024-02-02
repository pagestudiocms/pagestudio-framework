# Concepts 

## Adapter

The database adapter is a bridge between the virtual member manager profile and schema managers and the underlying database. The adapter looks up the data source and updates or queries the database using SQL queries. 

A database adapter is an implementation of a database connector. The connector is more at the conceptual level, while the adapter is at the implementation level, though they refer to the same thing. 
https://link.springer.com/referenceworkentry/10.1007/978-0-387-39940-9_1182#:~:text=A%20database%20adapter%20is%20an,refer%20to%20the%20same%20thing

## Driver 

Database drivers, programs that translate the Open Database Connectivity (ODBC) or JDBC calls to DBMS-specific calls, are used to link the application to any one of several databases that could be used as the data source. ODBC is a programming interface for accessing database systems.

(Tells the client application how to communicate with the database)

> [Database drivers] offer [application specific] connectivity libraries written to a specific data connectivity standard — like JDBC, ODBC, ...

> Under the cover, the database driver converts SQL queries in your application into a protocol language to talk to the database server and return query results to your application by converting the protocol language back to language spec results.